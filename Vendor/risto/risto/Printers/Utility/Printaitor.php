<?php

App::uses('Comandera', 'Model');
App::uses('Helper', 'View');
App::uses('FiscalPrinter', 'Printers.FiscalPrinter');


/**
 * Helps printing files in CUPS server
 * 
 * Implements one of the Printers Engines
 * It handles the logif of select what Engine to Use
 * based on configurations or methods that allow to change the current one
 * 
 * It work calling the send function
 *  Printaitor::send(array(
 *              'items' => array(
 *                          'prod1' => array('price' => 2.3),
 *                          'prod2' => array('price' => 5),
 *                  ),
 *              'client' => 'Robert Plant',
 *      ), 'theprinter', 'ticket') 
 * 
 * it builds the ticket.ctp view for the Fiscal Printer "theprinter" and renders the array into the view
 * Sends the view output to de PrinterOutput, by default is a CUPS server
 * 
 *
 * @author alejandro
 */
class Printaitor
{
  
    
    public static function setup( Model $printer , $id = null)
    {                
        
        if ( !self::$isLoad ) {
            if ( empty($outputEngine ) ) {
                $outputEngine = Configure::read('Printers.output');
            }
            // loads PrinterOutput Engine
            $po = $outputEngine;
            $po = empty( $po ) ? self::$defaultOutput : $po;
            self::_loadPrinterOutput( $po );

             // loads Fiscal Printer
            self::_loadFiscalPrinter();

            // loads Receipt Printers
            self::_loadReceiptPrinters();
        }
        
        self::$isLoad = true;
        
    }
    
    
    /**
     * Fiscal close "X" (partial) or "Z" (daily close)
     * @param char $type 
     */
    public static function  close( $type = 'X', $printer = null) {
        $type = strtoupper($type);
        if ( $type == "X" || $type == "Z" ) {
            throw new NotImplementedException("Cierre $type fiscal sin implementar");    
        } else {
            throw new Exception("Cierre no válido. Los valores solo pueden ser o X o Z, se pasó $type como parámetro");
        }
    }
    
    
/**
 * Perform printing to the output creating the view and using the $PrinterOutput object
 * 
 * @param array $dataToView iis the data to be passed into the view
 * @param string $printerName printer Key name to use with self::$ReceiptPrinters
 * @param string $viewName view file name like "ticket" from ticket.ctp
 * @return boolean returns the $PrinterOutput->send value
 */  
    public static function send($dataToView, $printerName, $viewName) {
       $textToPrint = self::_getView($dataToView, $printerName, $viewName);        
       return self::$PrinterOutput->send($textToPrint, $printerName); 
    }
    

    

/**
 * Gets the name of the printer engine
 * 
 * @return string
 */    
    public static function getEngineName() {
        return self::$PrinterOutput->name;
    }    
    
 
    
    
/**
 * Instanciates an Engine for change Output Printing
 * 
 * @param string $outputType
 *              Actualmente pueden ser la opciones: "cups" o "file"
 * @return PrinterOutput or false
 */
    public static function _loadPrinterOutput( $outputType ) {
        $outputType = ucfirst(strtolower( $outputType ));
        $printerOutputName = $outputType."PrinterOutput";
                
        App::uses($printerOutputName, "Printers.PrinterOutput");
        self::$PrinterOutput = new $printerOutputName();
    }
    
  
    
        
/**
 * Logic for creating the view rendered.
 * 
 * @param array $data all vars that will be accesible into the view
 * @param string $printerName name of the printer
 * @param string $templateName name of the view
 * @param string $driverName Builds the Helper. Is the driver or model name of the printer
 * @param string $sourceView View folder based on outputEngine (acts as controller->view)
 */    
    protected static function _getView($data, $printerName, $templateName, $driverName, $sourceView) { 
        $pluginPath = App::path('Lib', 'Printers');

        App::build(array('View' => array( $pluginPath . '/DriverView')));
        //becomes
        //App::build(array('View/Helper' => array('/full/path/to/View/Helper/')));


        $viewName = "Printers.$sourceView/$templateName";
        $View = new View();
        $View->set($data);               
        
        $View->helpers = array(
            'PE' => array(
                   'className' => 'Printers.'. $driverName
            )
        );
        
        return $View->render($viewName, false);
    }
        
 
    
}

?>
