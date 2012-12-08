/*
fislib.h
*/

#define DC2 18
#define DC4 20

#define ERR_NOPORT 		-1	// No hay un port libre para usar.
#define ERR_DEFPORT     -2  // Error en numero de port.

typedef void (*PFV)(int Reason, int Port);

int SetKeepAliveHandler	(PFV Handler);
int OpenCommFiscal 		(char *PortName);
int InitFiscal 			(int PortDesc);
int CloseCommFiscal 	(int PortDesc);
int MandaPaqueteFiscal 	(int PortDesc, char *Command, 
						unsigned short *FiscalStatus, 
						unsigned short *PrinterStatus, char *AnswerBuffer);

// Funciones Nuevas incorporadas a partir del impresor 320F.

int  SetBaudRate 			    (int PortDesc, long Baudios);
int  SetCommandRetries 		    (int Retries);
int  SetNewProtocol      	    (int Value);
void ObtenerNumeroDePaquetes    (int *Enviado, int *Recibido, int *CmdRecibido);
int  ObtenerStatusImpresor 		(int PortNumber, unsigned short *FiscalStatus, 
									unsigned short *PrinterStatus, 	
									char *AnswerBuffer);
int  SearchPrn 					(int PortDesc, long *Baud);

#define NO_ERROR      	 0
#define ERR_TIMEOUT 	-4
#define ERR_STATPRN    	-9
