<?php

App::uses('EnginesInterface', 'Lib/PrinterEngine');


/**
 * Implements one of the Printers Engines
 * It handles the logif of select what Engine to Use
 * based on configurations or methods that allow to change the current one
 *
 * @author alejandro
 */
class PrinterEngineBehavior extends ModelBehavior
{
/**
 * the printer instance setted as current
 * 
 * @var PrinterEngine instance 
 */    
    public $Engine;
    
    private $defaultEngine = 'FilePrinterEngine';
    
    
    public function setup(){
        
        App::uses('EnginesInterface', "Lib/PrinterEngine/Engine/$this->defaultEngine");
        
        $reflection = new ReflectionClass($this->defaultEngine);
        if ($reflection->isAbstract() || $reflection->isInterface()) {
                return false;
        }
        $this->Engine = $reflection->newInstance();
        
    }

/**
 * Gets the name of the printer engine
 * 
 * @return string
 */    
    public function getPrinterEngine() {
        return $this->Engine->name;
    }
    
}

?>
