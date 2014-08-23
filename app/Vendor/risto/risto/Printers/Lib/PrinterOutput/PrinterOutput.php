<?php

/**
 * Handles Printing methods like print by CUPS, or print a file to a folder
 *
 * @author alejandro
 */
class PrinterOutput
{
/**
 * Engine Name
 * 
 * @var string
 */    
    public  $name;
    
    
 /**
  * Engine constructor
  */   
    public function __construct() {
        if ($this->name === null) {
                    $this->name = substr(get_class($this), 0, -10);
        }
        
    }

/**
 * Returns the description of the print engine
 * 
 * @return string
 */        
    public  function description(){}
    
    
/**
 *  Do the print
 * 
 * @param string $texto es el texto a imprimir
 * @param string $nombreImpresoraFiscal nombre de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $texto, $nombreImpresoraFiscal, $hostname = '' ) {


}

?>
