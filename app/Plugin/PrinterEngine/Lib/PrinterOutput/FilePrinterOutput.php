<?php

App::uses('File', 'Utility');
App::uses('Folder', 'Utility');
App::uses('Inflector', 'Utility');
App::uses('PrinterOutput', 'PrinterEngine.PrinterOutput');

class FilePrinterOutput extends PrinterOutput
{
    
    public  $name = 'File';
    
    
/**
 * Path to where is goin to be created the folder inside /tmp
 * default is /tmp/files_to_print
 * @var string
 */    
    public $folder = 'files_to_print';
    
 
    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public  function description(){
        return "Prints files into /tmp/$this->folder. It's usefull for development";
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
            
            // crear carpeta
            $printerFolderPath = "/tmp/$nombreImpresoraFiscal";
            $folder = new Folder();
            $folder->create($printerFolderPath, 0777);
            
            // crear archivo
            
            $randomName = md5( "$printerFolderPath".$texto );
            $printerNamePath = "$printerFolderPath/$randomName.txt";
            $file = new File($printerNamePath , $create = true, 0777);
            $file->write($texto);
            return $file->close();
        }
        
}
?>
