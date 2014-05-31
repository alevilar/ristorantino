#define ANSWER_EXTENSION	".ans"

#define FS	0x1c		// ASCII 28
#if defined (UNIX) || defined (LINUX)
#define SLASH '/'
#define STATUS "*\n"
#define CANCEL_FISCAL_RECEIPT	"D 0.0C0\n"
#define CLOSE_FISCAL_RECEIPT	"E\n"
#define CLOSE_NON_FISCAL_RECEIPT "J\n"
#endif
#ifdef DOS
#define SLASH '\\'
#define STATUS "*"
#define CANCEL_FISCAL_RECEIPT	"D 0.0C0"
#define CLOSE_FISCAL_RECEIPT	"E"
#define CLOSE_NON_FISCAL_RECEIPT "J"
#endif

#define FATAL_FISCAL_FLAGS 0xfb
#define FISCAL_ERROR -2
#define PRINTER_ERROR -1

#define TMPFILE	"TmpAns.Ans"

#define DC2 18	// Usado cuando el impresor esta ocupado
#define DC4 20	// Usado para 'Falta Papel'

char *GetFirst (char *Directory);
char *GetNext (void);
void Debug (char DisplayMsg, char *msg, ...);
void ShowDebuggers (int val);

#define RETRY_MODE    1
#define NO_RETRY_MODE 2

int SendPrinterCommand (char *Command, int Mode);
