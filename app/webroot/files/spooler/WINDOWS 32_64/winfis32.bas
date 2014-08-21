Attribute VB_Name = "WinFis32"
'// ###################################################################################################################
'//  Cía. HASAR SAIC - Grupo HASAR                                                          Impresoras Fiscales Hasar
'//  VB 6.0 - SP5                                                                               Dto. Software de Base
'//  winfis32.dll v4.27                                                                             
'// ###################################################################################################################
Option Explicit

'// Funciones disponibles en winfis32.dll
'//---------------------------------------
Declare Sub Abort Lib "winfis32" (ByVal handler As Long)
Declare Sub SetKeepAliveHandlerStdCall Lib "winfis32" (ByVal Ptr As Long)
Declare Function VersionDLLFiscal Lib "winfis32" () As Long
Declare Function OpenComFiscal Lib "winfis32" (ByVal puerto As Long, ByVal mode As Long) As Long
Declare Function ReOpenComFiscal Lib "winfis32" (ByVal puerto As Long) As Long
Declare Function OpenTcpFiscal Lib "winfis32" (ByVal hostname As String, ByVal socket As Long, _
                                               ByVal miliseg As Double, ByVal mode As Long) As Long
Declare Sub CloseComFiscal Lib "winfis32" (ByVal handler As Long)
Declare Function InitFiscal Lib "winfis32" (ByVal handler As Long) As Long
Declare Function CambiarVelocidad Lib "winfis32" (ByVal handler As Long, ByVal NewSpeed As Long) As Long
Declare Sub BusyWaitingMode Lib "winfis32" (ByVal mode As Long)
Declare Sub ProtocolMode Lib "winfis32" (ByVal mode As Long)
Declare Function SetModeEpson Lib "winfis32" (ByVal modo As Boolean) As Long
Declare Function SearchPrn Lib "winfis32" (ByVal handler As Long) As Long
Declare Function MandaPaqueteFiscal Lib "winfis32" (ByVal handler As Long, ByVal Buffer As String) As Long
Declare Function UltimaRespuesta Lib "winfis32" (ByVal handler As Long, ByVal Buffer As String) As Long
Declare Function UltimoStatus Lib "winfis32" (ByVal handler As Long, ByRef FiscalStatus As Integer, _
                                              ByRef PrinterStatus As Integer) As Long
Declare Function SetCmdRetries Lib "winfis32" (ByVal cat As Long) As Long
Declare Function SetSndRetries Lib "winfis32" (ByVal cat As Long) As Long
Declare Function SetRcvRetries Lib "winfis32" (ByVal cat As Long) As Long
Declare Function ObtenerNumeroDePaquetes Lib "winfis32" (ByVal handler As Long, ByRef Paqsend As Long, _
                                                         ByRef Paqrec As Long, ByRef Idcmd As String) As Long

'// Constantes para manejarse con la DLL
'//-------------------------------------
Public Const MODE_ANSI = 1                  '// Usar caracteres ANSI.
Public Const MODE_ASCII = 0                 '// Usar caracteres ASCII.

Public Const BUSYWAITING_OFF = 0            '// Control en la DLL.
Public Const BUSYWAITING_ON = 1             '// Control en el software.

Public Const OLD_PROTOCOL = 0               '// Pasar a protocolo viejo.
Public Const NEW_PROTOCOL = 1               '// Pasar a protocolo nuevo.

'// Errores devueltos por las funciones de la DLL
'//----------------------------------------------
Public Const ERROR = -1                      '// La transmisión no se pudo completar.
Public Const ERR_HANDLER = -2                '// Handler inválido.
Public Const ERR_ATOMIC = -3                 '// Intento de enviar un comando cuando se estaba procesando el anterior.
Public Const ERR_TIMEOUT = -4                '// Error de comunicaciones (time-out).
Public Const ERR_ALREADYOPEN = -5            '// El puerto indicado ya estaba abierto.
Public Const ERR_NOMEM = -6                  '// Memoria host insuficiente.
Public Const ERR_NOTOPENYET = -7             '// Aun no se han inicializado las comunicaciones.
Public Const ERR_INVALIDPTR = -8             '// La dirección del buffer de respuesta es inválida.
Public Const ERR_STATPRN = -9                '// El comando no finalizó, sino que llegó una respuesta tipo STAT_PRN.
Public Const ERR_ABORT = -10                 '// El proceso en curso fue abortado por el usuario.
Public Const ERR_NOT_PORT = -11              '// No hay más puertos disponibles.
Public Const ERR_TCPIP = -12                 '// Error estableciendo una comunicación TCP/IP.
Public Const ERR_HOST_NOT_FOUND = -13        '// No existe el nodo en la red (conversor LAN / serie).
Public Const ERR_HOST_TIMEOUT = -14          '// Error conectando con el host(conversor LAN / Serie).
Public Const ERR_NAK = -15                   '// Se ha recibido NAK como respuesta.



'......................................................................................................................
'Declare Sub SetKeepAliveHandler Lib "Wtestf" (ByVal filelog As String)
'Sub ManejadorDeMantengaseVivo(ByVal Razon As Long, ByVal Puerto As Long)
    'Debug.Print "KeepAlive; Razon: " & Razon & " Puerto: " & Puerto
'End Sub

'Cuando carga el form main -- Para atrapar DC2 y DC4
'Sub PonerManejadorDeMantengaseVivo()
    'SetKeepAliveHandlerStdCall AddressOf ManejadorDeMantengaseVivo
'End Sub

