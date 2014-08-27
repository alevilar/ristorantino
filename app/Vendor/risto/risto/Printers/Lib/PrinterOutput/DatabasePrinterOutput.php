<?php

App::uses('PrinterJob', 'Printers.Model');

class DatabasePrinterOutput extends PrinterOutput
{
    
    public  $name = 'Database';


    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints files saving into database";
    }
    
    
/**
 * Crea un archivo y lo coloca en la carpeta /tmp
 * 
 * @param string $texto es el texto a imprimir
 * @param string $nombreImpresoraFiscal nombre de la impresora 
 * @param string $hostname nombre o IP del host
 * 
 * @return type boolean true si salio todo bien false caso contrario
 */
        public  function send( $texto, $nombreImpresoraFiscal, $hostname = '' ) {
            
            $nombreImpresoraFiscal = Inflector::slug($nombreImpresoraFiscal);
            
            $printJob = array(
            		'text' => $texto,
            		'printer_id' = $nombreImpresoraFiscal
            	);

            return ClassRegistry::init("Printers.PrinterJob")->save($printJob);
        }
        
}
