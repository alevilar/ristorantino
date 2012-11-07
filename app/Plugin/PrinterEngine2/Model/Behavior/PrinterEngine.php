<?php

App::uses('EnginesInterface', 'Lib/PrinterEngine');


/**
 * Implements one of the Printers Engines
 *
 * @author alejandro
 */
class PrinterEngine
{
    public $Engine;
    
    private $defaultEngine = 'FilePrinterEngine';
    
    public function __costructor(){
        
        App::uses('EnginesInterface', "Lib/PrinterEngine/Engine/$this->defaultEngine");
        
        $reflection = new ReflectionClass($this->defaultEngine);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
                return false;
        }
        $this->Engine = $reflection->newInstance();

    }
    
    public function getEngine() {
        
    }
    
}

?>
