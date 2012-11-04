<?php

/**
 * Handles Printing methods like print by CUPS, or print a file to a folder
 *
 * @author alejandro
 */
interface PrinterEnginesApp
{
    
/**
 * 
 * Do the print
 * 
 * var string $printerName
 *      Specifies the name or identifier of the destiny of the text
 * 
 * var string $textToPrint
 *      The text is going to be printed
 */    
    public function send($printerName, $textToPrint);
}

?>
