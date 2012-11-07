<?php
App::uses('PrinteableBehavior', 'PrinterEngine.Model/Behavior');

App::uses('Config','Model');



/**
 * PrinteableBehavior Test Case
 *
 */
class PrinteableBehaviorTestCase extends CakeTestCase {
    /**
     *
     * @var PrinteableBehavior 
     */
    public $Printeable;
    
    
/**
 * Fixtures used in the SessionTest
 *
 * @var array
 */
	public $fixtures = array('app.comandera');
    
    
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
                Configure::write('ImpresoraFiscal.nombre', 'fiscalfile');
                Configure::write('ImpresoraFiscal.modelo', 'Hasar441');
                
                
            debug(Configure::read(''));
            debug(Configure::read('ini'));
                        
		parent::setUp();
		$this->Printeable = new PrinteableBehavior();
                $this->Printeable->setup();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Printeable);

		parent::tearDown();
	}

/**
 * testGetPrinterFileEngine method
 *
 * @return void
 */
	public function testGetPrinterFileEngine() {
            $this->Printeable->_loadPrinterOutput('file');
            $this->assertEqual('file', strtolower( $this->Printeable->getEngineName() ) );
	}
        
        
/**
 * testGetPrinterCUPSEngine method
 *
 * @return void
 */
	public function testGetPrinterCUPSEngine() {
            $this->Printeable->_loadPrinterOutput('cups');
            $this->assertEqual('cups', strtolower( $this->Printeable->getEngineName() ) );
	}
        
        
/**
 * testGetPrinterCUPSEngine method
 *
 * @return void
 */
	public function testGetFiscalPrinterName() {
            $fp = $this->Printeable->getFiscalPrinter();
            
            // gets the printer name configured in setup 
            $this->assertEqual($fp->getPrinterName(), 'fiscalfile');
	}        
        
        
        public function testImprimirTicketConComandera() {
            $data = array(
                'items' => array(),
                'porcentaje_descuento' => 10,
                'total' => 100,
                'mozo' => 4,
                'mesa' => 20,
            );
            $this->Printeable->imprimirTicket($data, 'impresorita');
            
        }
}
