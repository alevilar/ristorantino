<?php


App::uses('ReceiptPrinterDriver', 'PrinterEngine.ReceiptPrinter');



class BematechDriver extends ReceiptPrinterDriver
{
    private $CORTAR_PAPEL = "w" ;
    private $ENFATIZADO = "E";
    private $SACA_ENFATIZADO = "F";
    private $TEXT_STRONG = "N4";
    private $TEXT_NORMAL ="N2";
    private $DOBLE_ALTO = "d1";
    private $SACA_DOBLE_ALTO = "d0";
    
    public function __construct()
    {
        $this->ESC = chr(27);
        $this->RETORNO_DE_CARRO = chr(13);
    }
}

