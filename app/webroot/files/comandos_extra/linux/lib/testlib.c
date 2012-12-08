/*
testlib.c

Programa de prueba de la libreria fiscal.

Compilar y linkear con la libreria de la siguiente manera: 

	$ cc -c testlib.c 
	$ cc -o testlib testlib.o fislib.a -lx 
*/

#include "unxlib.h"
#include <unistd.h>
#include <stdarg.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>

#define FS 			0x1c
#define CMD_STATPRN 0xa1

static int CountDC4 = 1;
static int CountDC2 = 1;
static int fdtty;
static unsigned short PrinterSt;
static unsigned short FiscalSt;
static char Answer[500];

#ifdef DEBUG
void 
FISdebug (char *fmt, ...)
{
	va_list argptr;
	static char BufLog [500];

	va_start(argptr, fmt);
	vsprintf (BufLog, fmt, argptr);
	va_end (argptr);

	printf ("DEBUG : [%s] \r\n", BufLog);
}
#endif

void
Show (char *Msg, char *buf)
{
	int c;

	printf ("%s", Msg);

	while ( *buf )
	{
		if ( (c = *buf++) == FS )
			putchar ('|');
		else putchar ( c );
	}
}
 
int 
ChequearImpresor (int ErrCode)
{
	int Rc; 
	char buffer[120];

	// Si la funcion MandaPaqueteFiscal devuelve ERR_STATPRN, 
	// es que el impresor no puede imprimir por falta de papel, 
	// error mecanico o no esta OnLine. 

	// Esta no es la respuesta al comando que se mando. Es una 
	// respuesta de error en la que el usuario puede enviar 
	// un mensaje al operador, indicando que solucione el problema 
	// del impresor. 

	// Esta logica es valida solo para el protocolo nuevo e impresores
	// nuevos, y evita que el programa quede bloqueado, esperando al 
	// impresor que salga de su estado de error.

	// Una vez recuperado, el impresor manda la respuesta original

	do
	{
		printf (" *** Error de Impresor *** \r\n");

		sprintf (buffer, "%c", CMD_STATPRN); 

		// Envia el comando CMD_STATPRN que encuesta al impresor.  
		// Si este salio de su estado de error, envia la respuesta 
		// al comando original. 

		Rc = MandaPaqueteFiscal (fdtty, buffer, &FiscalSt, &PrinterSt, Answer);

		if ( Rc != ERR_STATPRN && Rc != 0 )
		{
			printf ("Error de comunicacion con el impresor \r\n");
			exit (1);
		}

		sleep (2);
	}
	while ( Rc == ERR_STATPRN );

	return 0;
}

// Si el impresor detecta que falta papel, internamente se queda enviando 
// el caracter DC4 por la linea serie hasta que el problema queda 
// solucionado. Por otro lado si el impresor esta ocupado procesando 
// algun comando envia el caracter DC2.
// Esta funcion es ejecutada por la libreria toda vez que el impresor 
// envia los caracteres DC2 y DC4.
// Los contadores CountDC2 y CountDC4 deben ser puestos en 1 para cada 
// comando que se envie al impresor.

void
KeepAlive (int Caracter, int Port)
{
	if ( Caracter == DC4 && !(++CountDC4 % 10))
		printf ("Falta Papel ... \r\n");

	if ( Caracter == DC2 && !(++CountDC2 % 30) )
		printf ("Impresor Ocupado... \r\n");
}

void 
ResetCounters (void)
{
	CountDC4 = 1;
	CountDC2 = 1;
}

int 
main (int argc, char *argv[])
{
	int i;
	FILE *fp;
	char buffer[120];
	int Rc;
	long BaudsPrn;
	int FlagNewProtocol = 1;

	if (argc != 2 )
		exit (1);

	#ifdef LINUX
	fdtty = OpenCommFiscal ("ttyS0");
	#else
	fdtty = OpenCommFiscal ("tty1a");
	#endif

	if ( fdtty < 0 )
	{
		printf ("Error abriendo el port\r\n");
		exit (1);
	}

	if ( FlagNewProtocol ) 
	{
		// Seteo de velocidad y nuevo protocolo, con manejo de STATPRN.
		// No valido para impresoras PR4, 615, 614, 951, 262 (comentar 
		// estas lineas si se trata de un impresor de los mencionados).
		// En caso de no saber la velocidad del controlador, SearchPrn 
		// debe ejecutarse a continuacion del OpenCommFiscal, con el
		// objetivo de fijar la velocidad de comunicacion.

		printf ("Fijando modo de trabajo en protocolo nuevo ..\r\n");

		SetNewProtocol (1);

		printf ("Buscando controlador fiscal ..\r\n");

		if ( SearchPrn (fdtty, &BaudsPrn) < 0 )
		{
		  	printf ("Error tratando de fijar la velocidad\r\n");
		  	exit (1);
		}

		printf ("Controlador detectado a %ld\r\n", BaudsPrn);
	}

	else SetKeepAliveHandler (KeepAlive);

	InitFiscal (fdtty);

	if ( (fp = fopen (argv[1], "r")) == NULL )
	{
		printf ("Error abriendo %s\r\n", argv[1]);
		exit (1);
	}

	while ( fgets (buffer, sizeof (buffer), fp) )
	{
		Show ("Envio: ", buffer); 

		// Reset de los contadores de DC2 y DC4.
		ResetCounters ();

		Rc = MandaPaqueteFiscal (fdtty, buffer, &FiscalSt, &PrinterSt, Answer);

		if ( Rc < 0 )
		{
			if ( FlagNewProtocol && Rc == ERR_STATPRN )
				ChequearImpresor (Rc);
			
			else 
			{
				printf ("Error de comunicacion con el impresor Rc = %d\r\n", 
					Rc);
				exit (1);
			}
		}

		printf ("FiscalStatus:  %04X\r\n", FiscalSt);
		printf ("PrinterStatus: %04X\r\n", PrinterSt);

		Show ("Answer:        ", Answer);

		printf ("\r\n\n");
	}

	fclose (fp);

	CloseCommFiscal (fdtty);
}
