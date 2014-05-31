#include <unistd.h>

#include <fcntl.h>
#include <stdio.h>
#include <string.h>
#include <stdlib.h>
#include <stdarg.h>

#ifdef UNIX
#include <prototypes.h>
#endif 

#define FS			0x1c		// ASCII 28
#define CMD_STATPRN 0xa1

void
Error (char *Msg, ... )
{
    va_list argptr;
    char buffer[200];

    va_start (argptr, Msg);
    vsprintf (buffer, Msg, argptr);
    printf ("%s\n", buffer);
    va_end (argptr);

	exit (1);
}

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
main (int argc, char *argv[])
{
	FILE *fp;
	char buffer[200], *p;
	int fdpipe_command;
	int fdpipe_status, n;

	if ( argc != 2 )
		Error ("Uso: ftest <file>\n");

	if ( !(fp = fopen (argv[1], "r")) )
		Error ("Error abriendo %s\n", argv[1]);

	if ( (fdpipe_command = open ("/dev/p_write", O_WRONLY)) < 0 )
		Error ("Error abriendo pipe de escritura");

	if ( (fdpipe_status = open ("/dev/p_read", O_RDONLY)) < 0 )
		Error ("Error abriendo pipe de lectura");

	while ( fgets (buffer, sizeof (buffer), fp) )
	{
		Show ("Envio: ", buffer); 

		write (fdpipe_command, buffer, strlen (buffer));

		n = read (fdpipe_status, buffer, sizeof (buffer));

		// Si el string STATPRN viene como parte del mensaje de 
		// respuesta (al final), es que el impresor no puede imprimir 
		// por falta de papel, error mecanico o no esta OnLine. 

		// Esta no es la respuesta al comando que se mando. Es una 
		// respuesta de error en la que el usuario puede enviar 
		// un mensaje al operador, indicando que solucione el problema 
		// del impresor. 

		// Esta logica es valida solo para el protocolo nuevo e impresores
		// nuevos, y evita que el programa quede bloqueado, esperando al 
		// impresor que salga de su estado de error.

		// Una vez recuperado, el impresor manda la respuesta original

		if ( strstr (buffer, "STATPRN") )
		{
			do 
			{
				sleep (2);

				printf (" *** Error de Impresor *** \n");

				sprintf (buffer, "%c\n", CMD_STATPRN); 

				// Envia el comando CMD_STATPRN que encuesta al impresor.  
				// Si este salio de su estado de error, envia la respuesta 
				// al comando original. 

				write (fdpipe_command, buffer, strlen (buffer));

				// Leo la respuesta.

				n = read (fdpipe_status, buffer, sizeof (buffer));

				if ( strlen (buffer) == 2 && strstr (buffer, "-1") )
				{
					printf ("Error de comunicacion con el impresor \n");
					exit (1);
				}
			}

			while ( strstr (buffer, "STATPRN") );
		}

		if ( strlen (buffer) == 2 && strstr (buffer, "-1") )
		{
			printf ("Error de comunicacion con el impresor \n");
			exit (1);
		}

		Show ("Status: ", buffer);
	}
	
	fclose (fp);

	close (fdpipe_status);
	close (fdpipe_command);
}
