#if defined (UNIX) || defined (LINUX)
#include <unistd.h>
#endif

#include <stdio.h>
#include <stdarg.h>
#include <time.h>
#include <string.h>
#include <fcntl.h>
#include <stdlib.h>

#ifdef UNIX
#include <prototypes.h>
#endif 

#if !defined (UNIX) && !defined (LINUX)
#include <io.h>
#include <conio.h>
#endif 

#include "spooler.h"

char *FileLog = "spooler.log";
static char BufLog [512];

int my_debopen (char *file);

static int EnableDisplay = 1;

void
Debug (char DisplayMsg, char *msg, ...)
{
	va_list argptr;
	static char buf [512];
	time_t ct;
	struct tm *ptm;
	int fd;

	if ((fd = my_debopen (FileLog)) < 0 )
		return;

	time (&ct);
	ptm = localtime(&ct);

	sprintf(buf,"%02d/%02d-%02d:%02d:%02d: %s\n",
			ptm->tm_mday,
			ptm->tm_mon+1,
			ptm->tm_hour,
			ptm->tm_min,
			ptm->tm_sec,
			msg);

	va_start(argptr, msg);
	vsprintf (BufLog, buf, argptr);
	va_end (argptr);

	if ( EnableDisplay && DisplayMsg )
		printf ("%s", BufLog);

	write (fd, BufLog, strlen (BufLog));

	close (fd);
}

int
my_debopen (char *file)
{
	int fd;
	char FileBackUp[128];

	if (!file)
		return -1;

	if ((fd = open (file, O_WRONLY | O_CREAT | O_APPEND, 0666)) < 0)
		return fd;

	/* --- 
			Si el archivo de log es mayor que 500k, se renombra
			y se abre nuevamente. Se guarda una sola copia del log anterior.
	--- */

	if ( lseek(fd, 0L, 2) >= 500000L )
	{
		close (fd);

		strcpy (FileBackUp, file);
		FileBackUp[strlen(file)-2] = '_';

		unlink (FileBackUp);		
		rename (file, FileBackUp);

		/* --- Lo abre nuevamente --- */
		fd = open(file, O_CREAT | O_TRUNC | O_APPEND | O_WRONLY, 0666) ;
	}

	return fd;
}

void
ShowDebuggers (int val)
{
	EnableDisplay = (val != 0);
}

