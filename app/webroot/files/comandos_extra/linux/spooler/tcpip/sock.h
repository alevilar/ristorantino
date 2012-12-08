#if !defined(SOCK_H_INCLUDED)
#define SOCK_H_INCLUDED

#ifdef WIN32
#include <winsock.h>
#endif

#if defined (UNIX) || defined (LINUX)
typedef unsigned int        SOCKET;
#endif 

typedef unsigned long		INADDR;
typedef unsigned short		PORT;
typedef long				TIMEOUT;
#define WAITFOREVER			-1UL
#define MAX_SOCKETS			30

#define DIR_BCAST			0

// System Calls Nuevos. 
// Soportan Socket de TCP (Con conexio) y UDP (Sin Conexion)

int 	SockStream(PORT LocalPort);

int 	SockClose (SOCKET s);

int		SockListen(SOCKET s);

int		SockClose(SOCKET Sock);

int 	SockAccept(SOCKET StreamSock, INADDR *RemoteAddr, PORT *RemotePort,
			TIMEOUT Timeout);

int		SockConnect(SOCKET Sock, INADDR RemoteAddr, PORT RemotePort, 
			TIMEOUT Timeout);

int		SockSend(SOCKET Sock, void *Buf, unsigned BufLen, TIMEOUT Timeout);

int		SockReceive(SOCKET Sock, void *Buf, unsigned BufLen, TIMEOUT Timeout);

char *	GetIPAsc(INADDR address);

INADDR	GetHost(char *ipaddr);

char *GetSockError();

char *GetMyIpAddress (void);

#endif

