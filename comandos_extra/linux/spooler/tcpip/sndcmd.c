/*
sndcmd.c

Este es un programa de prueba que abre un socket de TCP/IP,
luego abre el archivo que fue pasado como parametro en la
linea de comandos, y  envia el contenido al spooler.
Puede ser compilado tanto en Win32, Linux o Unix.

Para compilar en Unix:
cc -o sndcmd -DUNIX -DSCO sndcmd.c socket.c debug.c -lsocket

Para compilar en Linux:
cc -o sndcmd -DLINUX sndcmd.c socket.c debug.c

Para compilar en Win32:
Ver makefile

*/

#include <errno.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <signal.h>
#include <fcntl.h>
#include <stdarg.h>

#ifdef UNIX
#include <prototypes.h>
#endif

#if defined (UNIX) || defined (LINUX) 
#include <unistd.h>
#include <sys/types.h>
#include <time.h>
#include <netdb.h>
#include <sys/select.h>
#include <sys/socket.h>
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

#ifdef WIN32
#include <winsock.h>
#endif 

#include "sock.h"

#define NEW_SOCK 0

static char Uso[] = "Uso: sndcmd [-p tcpport] -t host archivo \n";

extern char *optarg;
extern int  optind;

void usage (void);

int Transmit (char *file, char *Host, int ServerPort);

void 
usage (void)
{
	printf (Uso);
	exit (1);
}

Show (char *fmt, ...)
{
	int c;
	va_list  argptr;
	char buf[512];
	char *p = buf;
	#define FS 0x1C

	va_start (argptr, fmt);
	vsprintf (buf, fmt, argptr);
	va_end (argptr);

	while ( *p )
	{
		if ( (c = *p++) == FS )
			putchar ('|');
		else putchar ( c );
	}
}

int
main (int argc, char *argv[])
{
	int n;
	char Host[100];
	int ServerPort = 1600;

	signal (SIGINT, exit);
	signal (SIGTERM, exit);
	signal (SIGABRT, exit);

	while ( (n = getopt(argc, argv, "p:t:u")) != EOF ) 

        switch (n) 
		{
			case 'p':
				ServerPort = atoi (optarg);
				break;

			case 't':
				strcpy (Host, optarg);
				break;

            case 'u':
            default:
                usage ();
        }

	argc -= optind;
	argv += optind;

	if ( argc == 0 )
		usage ();

	Transmit (argv[0], Host, ServerPort);
}

int
Transmit (char *file, char *Host, int Port)
{
	struct hostent *phostent;
	INADDR RemoteAddr;
	PORT   RemotePort;
	FILE *fp;
	char comando[500];
	char respuesta[500];
	int n, fd;
	char *p;

	if ( (fd = SockStream (NEW_SOCK)) < 0 )
	{
		printf ("Error abriendo el port %d en TCP\n", NEW_SOCK);
		return -1;
	}

	if ( !(phostent = gethostbyname (Host)) ) 
	{
		#if defined (UNIX) || defined (LINUX)
		printf ("No se encontro el Host %s en el archivo /etc/hosts\n", Host);
		#else
		printf ("No se encontro el Host %s en el archivo hosts\n", Host);
		#endif
		return -1;
	}

	memcpy ( &RemoteAddr, phostent->h_addr, sizeof (INADDR));

	RemoteAddr = htonl (RemoteAddr);
	RemotePort = Port;

	printf ("Conectando a %s, port %d\n",  GetIPAsc (RemoteAddr), RemotePort);

	if ( SockConnect (fd, RemoteAddr, RemotePort, 15000) < 0 )
	{
		printf ("Error conectando al servidor\n");
		return -1;
	}

	if ( (fp = fopen (file, "r")) == NULL )
	{
		printf ("Error abriendo el archivo %s, errno %d\n", file, errno);
		exit (1);
	}

	while (fgets (comando, sizeof (comando), fp))
	{
		if ( (p = strchr (comando, '\n')) != NULL )
			*p = 0;

		if ( (p = strchr (comando, '\r')) != NULL )
			*p = 0;

		Show ("Envio     : [%s]\n", comando);

		if ( SockSend (fd, comando, strlen (comando), 15000) < 0 )
		{
			printf ("Error enviando el comando\n");
			return -1;
		}

		while (1)
		{
			n = SockReceive (fd, respuesta, sizeof (respuesta), 15000); 

			if (n < 0)
			{
				printf ("Error esperando la respuesta (Rc = %d), errno %d\n", 
					n, errno);
				return -1;
			}
			
			respuesta[n] = 0;

			if ( strstr (respuesta, "DC2") || strstr (respuesta, "DC4") )
				continue;

			break;
		}

		Show ("Respuesta : [%s]\n\n", respuesta);
	}

	fclose (fp);

	SockClose (fd);

	return 0;
}

