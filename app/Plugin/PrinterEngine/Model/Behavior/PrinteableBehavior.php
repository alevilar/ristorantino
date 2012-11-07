<?php

App::uses('ModelBehavior', 'Model');
App::uses('Comandera', 'Model');
App::uses('FiscalPrinter', 'PrinterEngine.FiscalPrinter');

App::uses('ReceiptPrinter', 'PrinterEngine.ReceiptPrinter');



/**
 * Implements one of the Printers Engines
 * It handles the logif of select what Engine to Use
 * based on configurations or methods that allow to change the current one
 *
 * @author alejandro
 */
class PrinteableBehavior extends ModelBehavior
{
/**
 * the printer putput instance setted: EJ: CUPS or File
 * 
 * @var PrinterOutput instance 
 */    
    private $PrinterOutput;
        
/**
 * Holds Fiscal Printer: Configure::read('ImpresoraFiscal.nombre')
 * 
 * @var FiscalPrinter 
 */    
    private $FiscalPrinter;
    
    
/**
 *
 * @var array of Model Comandera with the "name" as Key
 */    
    private $ReceiptPrinters;
    
    
 /**
  *
  * @var string
  *     Posilities are:
  *         "File" to print to a file where the path is configured in each Comanda
  *         "Cups" to print to a cups server printer. Where the "name" of Comanda is de name in CUPS printer
  * 
  */
    private $defaultOutput = 'File';
    
    
    public function setup(){
        
        // loads PrinterOutput Engine
        $this->_loadPrinterOutput( $this->defaultOutput );
        
         // loads Fiscal Printer
        $this->_loadFiscalPrinter();
        
        // loads Receipt Printers
        $this->_loadReceiptPrinters();
        
    }
    
    
/**
 *  Instanciates the Fiscal Printer into $this->FIscalPrinter
 */    
    private function _loadFiscalPrinter() {
        $this->FiscalPrinter = new FiscalPrinter();
    }
    
    
    
/**
 * Instanciates an Engine for change Output Printing
 * 
 * @param string $outputType
 *              Actualmente pueden ser la opciones: "cups" o "file"
 * @return PrinterOutput or false
 */
    public function _loadPrinterOutput( $outputType ) {
        $outputType = ucfirst(strtolower( $outputType ));
        $printerOutputName = $outputType."PrinterOutput";
                
        App::uses($printerOutputName, "PrinterEngine.PrinterOutput");
        $reflection = new ReflectionClass($printerOutputName);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
                return false;
        }
        $this->PrinterOutput = $reflection->newInstance();
    }
    

/**
 * Gets the name of the printer engine
 * 
 * @return string
 */    
    public function getEngineName() {
        return $this->PrinterOutput->name;
    }
    
 
/**
 * Send gateway betwen app and the Engine
 * 
 * @param string $texto
 * @param string $printer 
 */    
    private function _send($texto, $printer ) {
        $hostname = Configure::read('ImpresoraFiscal.server');
        $this->PrinterOutput->send( $texto, $printer, $hostname );
    }
        

    
/**
 * Getter of the FiscalPrinter attribute
 * 
 * @return FiscalPrinter
 */    
    public function getFiscalPrinter() {
        return $this->FiscalPrinter;
    }
    
    
    
    public function imprimirTicket( $data, $impresoraName) {
        $name = Configure::read('Printers.ticket_template');
        $viewName = 'PrinterEngine.ReceiptPrinter/' .$name  ;
        $View = new View();
        $View->set($data);            
        
        $textToPrint = $View->render($viewName, false);
        
        $this->PrinterOutput->send($textToPrint, $impresoraName);
    }
    
    
    
    public function PrintReceipt( $data, $impresoraName) {
        $name = Configure::read('Printers.receipt_template');
        $viewName = 'PrinterEngine.ReceiptPrinter/' .$name  ;
        $View = new View();
        $View->set($data);            
        
        $textToPrint = $View->render($viewName, false);
        
        $this->PrinterOutput->send($textToPrint, $impresoraName);
    }
    
 
/**
 * Gets from DDBB all Comanderas and put into ReceiptPrinters class var array
 * 
 * @return array $this->ReceiptPrinters
 */    
    private function _loadReceiptPrinters() {
        $ComanderaModel = ClassRegistry::init('Comandera');
        $ComanderaModel->recursive = -1;
        $comanderas =  $ComanderaModel->find('all');
        foreach ($comanderas as $c ) {
            $key = $c['Comandera']['name'];
            $value = new ReceiptPrinter( $c['Comandera'] );
            // puts into array with name as KEY
            $this->ReceiptPrinters[ $key ] = $value;
        }
        return $this->ReceiptPrinters;
    }

    
/**
 *  Gets the Receipt printer marked as imprime_ticket = 1
 *  If couldn't find any, returns the first in array
 * 
 *  @return ReceiptPrinter
 */    
    public function getDefaulReceiptPrinter() {
        foreach ($this->ReceiptPrinters as $rp ) {
            if ($rp->imprimeTicket()) {
                return $rp;
            }
        }
        return array_shift(array_values($this->ReceiptPrinters));
    }
    
}

?>
