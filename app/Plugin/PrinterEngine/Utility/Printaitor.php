<?php

App::uses('Comandera', 'Model');
App::uses('Helper', 'View');
App::uses('FiscalPrinter', 'PrinterEngine.FiscalPrinter');


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
/**
 * the printer putput instance setted: EJ: CUPS or File
 * 
 * @var PrinterOutput instance 
 */    
    protected static $PrinterOutput;
        
/**
 * Holds Fiscal Printer: Configure::read('ImpresoraFiscal.nombre')
 * 
 * @var FiscalPrinter 
 */    
    protected static $FiscalPrinter;
    
    
/**
 *
 * @var array of Model Comandera with the "name" as Key
 */    
    protected static $ReceiptPrinters;
    
    
/**
 *  Methos load is call once, and this is the flag
 * 
 * @var boolean 
 */    
    private static $isLoad = false;
    
    
 /**
  *
  * @var string
  *     Posilities are in Folder PrinterOutput:
  *         "File" to print to a file where the path is configured in each Comanda
  *         "Cups" to print to a cups server printer. Where the "name" of Comanda is de name in CUPS printer
  * 
  */
    protected static $defaultOutput = 'Cups';
    
    
    public static function setup()
    {        
        if ( !self::$isLoad ) {
            
            // loads PrinterOutput Engine
            $po = Configure::read('Printers.output');
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
 *  Instanciates the Fiscal Printer into self::$FiscalPrinter
 */    
    protected static function _loadFiscalPrinter() {
        
        $ComanderaModel = ClassRegistry::init('Comandera');
        $ComanderaModel->recursive = -1;
        $comandera =  $ComanderaModel->find('first', array('conditions' => array(
            'Comandera.imprime_ticket' => 1,
        )));
        self::$FiscalPrinter = $comandera['Comandera'];
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
                
        App::uses($printerOutputName, "PrinterEngine.PrinterOutput");
        self::$PrinterOutput = new $printerOutputName();
    }
    
    
    

    /**
     *  If printer is fiscal return true
     * 
     * @param string $printerName
     * @return boolean 
     */
    public static function _isFiscal($printerName) {
         if ( !empty(self::$FiscalPrinter) ) {
             if ( self::$FiscalPrinter['name'] == $printerName && !empty(self::$FiscalPrinter['imprime_ticket']) )
             return true;
         }
         return false;
    }
    

    
/**
 * Getter
 * 
 * @return array based on find('first') of Comandera 
 */    
    public function getFiscalPrinter(){
        return self::$FiscalPrinter;
    }

    /**
     *  If printer is receipt return true
     * 
     * @param string $printerName
     * @return boolean 
     */
    public static function _isReceipt($printerName) {
         if ( !empty(self::$ReceiptPrinters[$printerName]) && empty(self::$ReceiptPrinters[$printerName]['imprime_ticket']) ) {
             return true;
         }
         return false;
    }    
            
        
/**
 * Logic for creating the view rendered.
 * 
 * @param array $data all vars that will be accesible into the view
 * @param string $driverName Builds the Helper. Is the driver or model name of the printer
 * @param string $templateName name of the view
 */    
    protected static function _getView($data, $printerName, $templateName) {

        $sourceView = 'ReceiptPrinter';
        if ( self::_isFiscal($printerName) ) {
            $sourceView = 'FiscalPrinter';
            $driverName = self::$FiscalPrinter['driver_name'];
        } else {
            $driverName = self::$ReceiptPrinters[$printerName]['driver_name'];
        }
        
        
        $viewName = "PrinterEngine.$sourceView/$templateName";
        $View = new View();
        $View->set($data);               
        
        $View->helpers = array(
            'PE' => array(
                   'className' => 'PrinterEngine.'. $driverName
            )
        );
        
        return $View->render($viewName, false);
    }
        
 
/**
 * Gets from DDBB all Comanderas and put into ReceiptPrinters class var array
 * 
 * @return array self::$ReceiptPrinters
 */    
    protected static function _loadReceiptPrinters() {
        $ComanderaModel = ClassRegistry::init('Comandera');
        $ComanderaModel->recursive = -1;
        $comanderas =  $ComanderaModel->find('all', array('conditions' => array(
            'Comandera.imprime_ticket' => 0,
        )));
        foreach ($comanderas as $c ) {
            $key = $c['Comandera']['name'];
            
            // puts into array with name as KEY
            self::$ReceiptPrinters[ $key ] = $c['Comandera'];
        }
        return self::$ReceiptPrinters;
    }

    
/**
 *  Gets the Receipt printer marked as es_impresora = 1
 *  If couldn't find any, returns the first in array
 * 
 *  @return ReceiptPrinter
 *              if any, return null
 */    
    private static function _getDefaulReceiptPrinter() {
        foreach (self::$ReceiptPrinters as $rp ) {
            if ( !empty($rp['es_impresora']) ) {
                return $rp;
            }
        }
        // if any, return null
        return null;
    }
    
}

// initialization
Printaitor::setup();
?>
