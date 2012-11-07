<?php

/**
 *  Holds the logic to Build an obect based on configured model
 *  and makes a gateway betwen de aplication and the printer
 */
class ReceiptPrinter
{
        private $Driver;
        
        
        // Attributes based on Comanderas table in ddbb
        private $_attrs = false;
    

/**
 * Builds the Comandera object based in name and modesl setted in ddbb
 * 
 * @param array $params are the fields of Comanderas table
 */        
        public function __construct($params)
        {
            $this->_attrs = $params;
            
            // brings the Driver class
            $modeloImpresora = $params['driver_name'].'Driver';
            App::uses($modeloImpresora, 'PrinterEngine.ReceiptPrinter/Driver');
            
            // build instance and put into $this->Driver
            $reflection = new ReflectionClass($modeloImpresora);
            if ($reflection->isAbstract() || $reflection->isInterface()) {
                    return false;
            }
            
            // sets the Driver
            $this->Driver = $reflection->newInstance();
        }

        public function imprimeTicket() {
             return $this->_attrs['imprime_ticket'];
        }
        
}
?>
