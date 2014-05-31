<?php


class BematechHelper extends PrinterHelperSkel
{
    
    protected $_cmd = array(
        'ESC' => array('chr', 27),
        'RETORNO_DE_CARRO' => array('chr', 13),
        'CORTAR_PAPEL' => "w",
        'ENFATIZADO' => "E",
        'SACA_ENFATIZADO' => 'F',
        'TEXT_STRONG' => 'N4',
        'TEXT_NORMAL' => 'N2',
        'DOBLE_ALTO' => 'd1',
        'SACA_DOBLE_ALTO' => 'd0',
    );
    
}

