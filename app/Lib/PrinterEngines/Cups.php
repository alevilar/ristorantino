<?php

class CupsPrinterEngine extends PrinterEngine
{
/**
 *  Comando cups de impresion
 * 
 * @param type $nombreImpresoraFiscal nombre CUPS de la impresora 
 * @param type $texto es el texto a imprimir
 * @return type boolean true si salio todo bien false caso contrario
 */
        function cupsPrint( $nombreImpresoraFiscal, $texto ) {
            $serverImpresoraFiscal = Configure::read('ImpresoraFiscal.server');
            
            // cambiar el encoding del texto si esta configurado
            $encoding = Configure::read('ImpresoraFiscal.encoding');
            if (!empty( $encoding )) {
                $texto = mb_convert_encoding($texto, $encoding, mb_detect_encoding($texto));
            }
                    
            $descriptorspec = array(
               0 => array("pipe", "r"), //esto lo uso para mandarle comandos
               1 => array("pipe", "w"),  // el stdout a un archivo tmp
               2 => array("file", "/tmp/lprerrout.txt", "a") // el stderr a un archivo tmp
            );
            $process = proc_open('lp -h '.$serverImpresoraFiscal.' -d '.$nombreImpresoraFiscal, $descriptorspec, $pipes, '/tmp', null);

            if (is_resource($process)) 
            {
                    fwrite($pipes[0],$texto);
                    
                    fclose($pipes[0]);
                    fclose($pipes[1]);
                    $ret =  proc_close($process);
                    return true;
            }
            return false;
        }
        
}
?>
