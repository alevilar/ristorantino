<?php


class EscPDriver extends ReceiptPrinterHelperSkel
{    
    
     protected $_cmd = array(
        'ESC' => array('chr', 27),
        'CORTAR_PAPEL' => "w",
        'ENFATIZADO' => "E1",
        'SACA_ENFATIZADO' => 'E0',
    );
    
}
