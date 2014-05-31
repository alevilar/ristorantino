/*
socket.c
*/

/* Rutinas de comunicacion basadas en sockets */

#if defined (UNIX) || defined (LINUX) 
#include <unistd.h>
#include <sys/types.h>
#include <time.h>
#include <netdb.h>
#include <sys/select.h>
#include <sys/socket.h>
#endif

#ifdef UNIX
#include <prototypes.h>
#endif

#ifdef UNIX
#include <sys/netinet/in.h>
#include <arpa/inet.h>
#endif 

#ifdef LINUX
#include <netinet/in.h>
#include <arpa/inet.h>
#include <sys/time.h>
#endif

#include <errno.h>
#include <stdio.h>
#include <stdlib.h>
#include <string.h>

#ifndef LINUX
#include <time.h>
#endif

#include "sock.h"
#include "werror.h"
#include "spooler.h"

#define MAX_CONNECTIONS 5

#define WRITEABLE		1
#define READABLE		2
#define EXCEPTION		3

static int SocketInicializado;

/* Funciones estaticas */
#ifdef WIN32
extern HKEY GetIPKey(void);
static int InitWinSock  (void);
#endif 

static int DoTimeout (SOCKET S, TIMEOUT Timeout, int Mode);

/* RUTINAS PARA SOCKET CON CONEXION */

// Abro un socket con conexion (TCP). 
// Recibe el numero de port a abrir 

int 
SockStream(PORT LocalPort)
{
	int sockfd;
	struct sockaddr_in name;
	int n;
	int lenname;
	int yes=1;
	struct linger linger_opt;
	
	#ifdef WIN32

	if ( InitWinSock () < 0 )
	   return SOCK_ERRINIT;

	if ((sockfd = socket (AF_INET, SOCK_STREAM, 0)) == INVALID_SOCKET )
	   return -1;

	/* Le deshabilito del delay del socket */
	setsockopt (sockfd, IPPROTO_TCP, TCP_NODELAY, (char *)&yes, sizeof(yes));

	#endif

	#if defined (UNIX) || defined (LINUX)
	if ((sockfd = socket (AF_INET, SOCK_STREAM, 0)) < 0)
	{
		printf ("socket error = %d, errno %d\n", sockfd, errno);
	   	return sockfd;
	}
	#endif

	#ifdef UNIX
	setsockopt (sockfd, SOL_SOCKET, SO_REUSEPORT, (char *) &yes, sizeof (yes));
	#endif

	setsockopt (sockfd, SOL_SOCKET, SO_REUSEADDR, (char *) &yes, sizeof (yes));

	linger_opt.l_onoff = 1;    /* option on/off */
    linger_opt.l_linger = 0;   /* linger time (in seconds) */

	setsockopt (sockfd, 
		SOL_SOCKET, SO_LINGER, (char *) &linger_opt, sizeof (linger_opt));

	memset ((char *)&name, 0, sizeof (name));
	name.sin_family = AF_INET;
	name.sin_addr.s_addr = htonl(INADDR_ANY);
		
	// Si socket_nr == 0 el sistema asigna un port sin usar
	name.sin_port = htons((unsigned short) LocalPort );

	if( (n = bind (sockfd, (struct sockaddr *) &name, sizeof (name))) < 0 )
	{
		printf ("bind error = %d, errno %d\n", n, errno);
	    return -1;
	}

	lenname = sizeof (name);
	getsockname (sockfd, (struct sockaddr *)&name, &lenname);
	Debug (0, "Port local = %u\n", ntohs (name.sin_port) );

	return sockfd;
}

int 
SockClose (SOCKET s)
{
	#ifdef WIN32
	return closesocket (s);
	#else
	return close (s);
	#endif
}

// Prepara el socket para conectarse con un cliente. 
// Es usada por el Servidor

int 
SockListen(SOCKET s)
{
	return listen (s, MAX_CONNECTIONS);
}

// Se queda esperando una conexion. Puede recibir un timeout.
// Es usada por el Servidor 

int 
SockAccept (SOCKET StreamSock, 
	INADDR *RemoteAddr, PORT *RemotePort, TIMEOUT Timeout)
{
	struct sockaddr_in RemAddr;
	int Addrlen = sizeof (RemAddr);
	int n;
	int yes=1;

	if ( (n = DoTimeout (StreamSock, Timeout, READABLE)) < 0 )
		return SOCK_ETIMEOUT;

	#ifdef WIN32
	if ( (n = accept (StreamSock, 
		(struct sockaddr *) &RemAddr, &Addrlen )) == INVALID_SOCKET )
		return -1;

	setsockopt (n, IPPROTO_TCP, TCP_NODELAY, (char *)&yes, sizeof(yes));
	#endif

	#if defined (UNIX) || defined (LINUX)
	if ( (n = accept (StreamSock, 
		(struct sockaddr *) &RemAddr, &Addrlen )) < 0 )
		return -1;
	#endif

	*RemoteAddr = ntohl (RemAddr.sin_addr.s_addr);
	*RemotePort = ntohs (RemAddr.sin_port);

	return n;
}

// Se conecta con un servidor. Es usada por el cliente 

#define DELAY 100

int	
SockConnect (SOCKET Sock, 
	INADDR RemoteAddr, PORT RemotePort, TIMEOUT Timeout)
{
	struct sockaddr_in name;

	memset ((char *)&name, 0, sizeof (name));

	name.sin_family      = AF_INET;
	name.sin_addr.s_addr = htonl(RemoteAddr);
	name.sin_port        = htons((unsigned short) RemotePort);

	if( connect (Sock, (struct sockaddr *) &name, sizeof (name)) == 0 )
		return 0;

	return -1;
}

// Envia datos a la conexion. Solo usado para TCP 

int	
SockSend (SOCKET Sock, void *Buf, unsigned BufLen, TIMEOUT Timeout)
{
	int n;

	if ( (n = DoTimeout (Sock, Timeout, WRITEABLE)) < 0 )
		return SOCK_ETIMEOUT;

	return send (Sock, (char *) Buf, BufLen, 0);
}

// Recibe datos de una conexion. Solo usada para TCP 

int	
SockReceive (SOCKET Sock, void *Buf, unsigned BufLen, TIMEOUT Timeout)
{
	int n;

	if ( (n = DoTimeout (Sock, Timeout, READABLE)) < 0 )
		return SOCK_ETIMEOUT;

	// En Win32, recv retorna 0, si la conexion se cerro. 
	// No es asi en Unix.

	n = recv (Sock, (char *) Buf, BufLen, 0);

	if ( n <= 0 )
		return SOCK_ERRNOCONECT;

	return n;
}

static int 
DoTimeout (SOCKET S, TIMEOUT Timeout, int Mode )
{
	fd_set readfds;
    fd_set writefds;
	fd_set exceptionfds;
	struct timeval t;
	int rc;

	if ( Timeout == WAITFOREVER )
		return 1;
		
	t.tv_sec  = Timeout / 1000;
	t.tv_usec = (Timeout % 1000) * 1000; 

	switch ( Mode )
	{
		case WRITEABLE:
			FD_ZERO (&readfds);
			FD_ZERO (&writefds);
			FD_ZERO (&exceptionfds);
			FD_SET  (S, &writefds);
			break;
	
		case READABLE:
			FD_ZERO (&writefds);
			FD_ZERO (&readfds);
			FD_ZERO (&exceptionfds);
			FD_SET  (S, &readfds);
			break;
		case EXCEPTION:
			FD_ZERO (&writefds);
			FD_ZERO (&readfds);
			FD_ZERO (&exceptionfds);
			FD_SET  (S, &exceptionfds);
			break;
	}

	/*
	 * select retorna: -1 si hubo error.
	 *                  0 si hubo timeout.
	 *                  != 0 si no hubo error.
	 */

    rc = select (S + 1, 
		&readfds, &writefds, &exceptionfds, Timeout ? &t : NULL);

	switch (rc)
	{
		case  0:
			return SOCK_ETIMEOUT;	// Error de Timeout 
		case  1:
			return 0;	// OK
		case -1:
		default:
			return SOCK_GENERALERROR;
	}
}

// Recibe una direccion de IP en formato INADDR (long) y retorna la direccion
// con formato XXX.XXX.XXX.XXX 

char *
GetIPAsc(INADDR address)
{
	struct in_addr in;
	
	in.s_addr = ntohl(address);
	return inet_ntoa(in);	
}

#ifdef WIN32

// Obtiene un HKEY abierto apuntando a un valor IPAddress v lido.
// Devuelve NULL si no lo encontr¢.

static HKEY
GetIPKey (void)
{
	char IPAddress[100];
	unsigned long SizeIP;
	static HKEY hkey;
	HKEY hRoot;
	int Index;
	char SubKey[300];
	int SubKeySize;

	#define MAX_PROTOCOLS 10

	char *Root = "System\\CurrentControlSet\\Services\\Class\\NetTrans";

	if (RegOpenKeyEx (HKEY_LOCAL_MACHINE, 
		Root, 0L, KEY_ENUMERATE_SUB_KEYS, &hRoot) != ERROR_SUCCESS)
		return NULL;

	for (Index = 0; Index < MAX_PROTOCOLS; Index++)
	{
		SubKeySize = sizeof(SubKey);

		if (RegEnumKeyEx (hRoot, Index, 
			SubKey, &SubKeySize, NULL, NULL, NULL, NULL) != ERROR_SUCCESS)
			return NULL;

		if (RegOpenKeyEx(hRoot, 
			SubKey, 0L, KEY_QUERY_VALUE, &hkey) != ERROR_SUCCESS)
			continue;
				
		/*
		Encontr‚ una direcci¢n de IP v lida, y no es "0.0.0.0", 
		es decir, una direcci¢n de IP obtenida de un servidor de 
		direcciones de IP, como el acceso telef¢nico a redes.
		*/
		
		SizeIP = sizeof(IPAddress);
	
		if (RegQueryValueEx (hkey,	
							"IPAddress", 
							NULL, 
							NULL, 
							IPAddress, &SizeIP) == ERROR_SUCCESS 
			&& strcmp(IPAddress, "0.0.0.0"))
			break;
		
		RegCloseKey (hkey);
	}
	
	if (Index == MAX_PROTOCOLS)
		return NULL;
	
	return hkey;
}

// Retorna la Direccion de IP de la maquina donde corre el programa 

static int 
gethostid (INADDR *ipaddr,long *mask)
{
	char IPAddress[100], Mask[100];
	unsigned long SizeIP, SizeMask;
	HKEY hkey;
	static INADDR ip;
	static long ipmask;

	if( ip )
	{
		*ipaddr = ip;
		*mask = ipmask;
		return 0;
	}

	if (!(hkey = GetIPKey()))
		return -1;

	SizeIP = sizeof(IPAddress);
	RegQueryValueEx (hkey, "IPAddress", NULL, NULL, IPAddress, &SizeIP);

	SizeMask = sizeof(Mask);
	RegQueryValueEx (hkey, "IPMask", NULL, NULL, Mask, &SizeMask);

	ip = *ipaddr = htonl(inet_addr(IPAddress));
	ipmask = *mask = htonl(inet_addr(Mask));
	RegCloseKey (hkey);
	return 0;
}

// Obtiene la direccion de IP de la PC.

char *
GetMyIpAddress (void)
{
	struct in_addr in;
	long   Mask;
	
	if ( gethostid (&in.s_addr, &Mask) )
		return NULL;

	in.s_addr = ntohl (in.s_addr);
	
	return inet_ntoa (in);
}

// Inicializa la DLL WinSock 
static int
InitWinSock (void)
{
	WORD wVersionRequested;
	WSADATA wsaData;
	int err;

	if ( SocketInicializado )
		return 0;

	SocketInicializado = 1;
	
	wVersionRequested = MAKEWORD( 1, 1 ); // 2, 0 );

	err = WSAStartup( wVersionRequested, &wsaData );

	if ( err != 0 ) 
	{
		/* Tell the user that we couldn't find a usable */
		/* WinSock DLL.                                  */
		return -1;
	}

	/* Confirm that the WinSock DLL supports 2.0.*/
	/* Note that if the DLL supports versions greater    */
	/* than 2.0 in addition to 2.0, it will still return */
	/* 2.0 in wVersion since that is the version we      */
	/* requested.                                        */

//	if ( LOBYTE( wsaData.wVersion ) != 2 ||	HIBYTE( wsaData.wVersion ) != 0 ) 
	if ( LOBYTE( wsaData.wVersion ) != 1 ||	HIBYTE( wsaData.wVersion ) != 1 ) 
	{
		/* Tell the user that we couldn't find a usable */
		/* WinSock DLL.                                  */
		WSACleanup( );
		return -1; 
	}

	return 0;
}

#endif 

