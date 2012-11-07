<?php



App::uses('ReceiptPrinterDriver', 'PrinterEngine.ReceiptPrinter');


class EscPDriver extends ReceiptPrinterDriver
{    
    
    private $CORTAR_PAPEL = "w";
    private $ENFATIZADO = "E1";
    private $SACA_ENFATIZADO = "E0";
    
/**
 * Constructors is used to build constants that needs to call a function
 */    
    public function __construct() {
        $this->ESC = chr(27);
    }
    
}