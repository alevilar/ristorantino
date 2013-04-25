<?php

App::uses('File', 'Utility');

class FilePrinterEngine extends EnginesInterface
{
    
    public $name = 'File';
    
    
/**
 * Path to where is goin to be created the folder inside /tmp
 * default is /tmp/files_to_print
 * @var string
 */    
    public $folder = 'files_to_print';
    
    
/**
 * Returns name of the printer engine 
 * @return string
 */   
    public static function name(){
        return $this->name;
        
    }
    
/**
 * Returns the description of the print engine
 * @return string
 */        
    public static function description(){
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
        public static function send( $texto, $nombreImpresoraFiscal, $hostname = '' ) {
            // crear carpeta
            $printerFolderPath = "/tmp/$printerName";
            $folder = new Folder();
            $folder->create($printerFolderPath, '0777');
            
            // crear archivo
            $printerName = Inflector::slug($nombreImpresoraFiscal);
            $randomName = rand(1, 9999999999);
            $printerNamePath = "$printerFolderPath/$randomName.txt";
            $file = new File($printerNamePath , $create = true, 0777);
            $file->write($texto);
            return $file->close();
        }
        
}
?>
