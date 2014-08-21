/*
	winfis.h:

	Declaraciones de prototipos exportables de la DLL.

*/

#ifndef _WINFIS_H
#define _WINFIS_H

#ifdef __cplusplus
extern "C" {
#endif

#define VERSION 427

#ifdef WIN32
	#define _export
	typedef void (*PFV)(int Reason, int Port);
	typedef void (__stdcall *PFVSTDCALL)(int Reason, int Port);
#endif

int  FAR PASCAL _export 	OpenComFiscal (int Com, int Mode);

int	FAR PASCAL _export      OpenTcpFiscal (char *HostName,
								int Socket, long TimeoutMilisecs, int Mode);
#ifdef WIN32
int  FAR PASCAL _export 	ReOpenComFiscal (int Com);
#endif

void FAR PASCAL _export 	CloseComFiscal (int Handler);
int  FAR PASCAL _export 	MandaPaqueteFiscal (int Handler, char *Buffer);
int  FAR PASCAL _export		UltimaRespuesta (int Handler, char *Buffer);
int	 FAR PASCAL _export		UltimoStatus (int Handler, short *FiscalStatus,
														short *PrinterStatus);
int  FAR PASCAL _export		VersionDLLFiscal (void);
int  FAR PASCAL _export		InitFiscal (int Handler);
void FAR PASCAL _export		BusyWaitingMode (int Mode);
int  FAR PASCAL _export		CambiarVelocidad(int Handler, long NewSpeed);
void FAR PASCAL _export		ProtocolMode(int Mode);
long FAR PASCAL _export		SearchPrn (int Handler);

int FAR PASCAL  _export     ObtenerNumeroDePaquetes (int Handler,
								int *Enviado, int *Recibido,
								int *CmdRecibido);
#ifdef WIN32
void FAR PASCAL _export		SetKeepAliveHandler(PFV Handler);
void FAR PASCAL _export		SetKeepAliveHandlerStdCall(PFVSTDCALL Handler);
void FAR PASCAL _export		Abort(int Handler);
#endif

int FAR PASCAL _export 		SetCmdRetries (int Retries);
int FAR PASCAL _export 		SetSndRetries (int Retries);
int FAR PASCAL _export      SetRcvRetries (int Retries);

int FAR PASCAL _export      SetModoEpson (int Modo);

#define SIZEANSWER   1024

#define MODE_ASCII	0
#define MODE_ANSI	1

#define BUSYWAITING_OFF 0
#define BUSYWAITING_ON  1

#define OLD_PROTOCOL	0
#define NEW_PROTOCOL	1

#ifdef __cplusplus
}
#endif


#endif // _WINFIS_H
