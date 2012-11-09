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
 * Default testing printer output
 * 
 * @var array default is File, but can be CUPS, for example
 */        
        public $printerOutput = 'file';
    
    
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
                Configure::write('ImpresoraFiscal.nombre', 'fiscalfile');
                Configure::write('ImpresoraFiscal.modelo', 'Hasar441');
                        
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
            $this->printerOutput = 'file';
            $this->Printeable->_loadPrinterOutput($this->printerOutput);
            $this->assertEqual($this->printerOutput, strtolower( $this->Printeable->getEngineName() ) );
	}
        
        
/**
 * testGetPrinterCUPSEngine method
 *
 * @return void
 */
	public function testGetPrinterCUPSEngine() {
            $this->printerOutput = 'cups';
            $this->Printeable->_loadPrinterOutput($this->printerOutput);
            $this->assertEqual($this->printerOutput, strtolower( $this->Printeable->getEngineName() ) );
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
        
        
        public function testPrintReceipt() {
            $data = array(
                    'entradas' => array(),
                    'platos_principales' => 1,
                    'productos' => array(
                        array(
                        'DetalleComanda' => array(
                            'cant' => 1,
                            'observacion' => 'muy frio',
                            ),
                        'Producto' => array(
                            'name' => 'Productino Nombre',
                        ),
                        'DetalleSabor' => array(
                            array(
                                'Sabor' => array(
                                    'name' => 'tomate',
                                ),
                            ),
                            array(
                                'Sabor' => array(
                                    'name' => 'lechuga',
                                ),
                            )
                        )
                        ))
            );
            $result = $this->Printeable->PrintReceipt($data, 'barra');
                        
            $this->assertEqual($result, true);
        }
        
        
        
        
        public function testPrintReceiptTicket() {
            $data = array(
                'items' => array(),
                'porcentaje_descuento' => 10,
                'total' => 100,
                'mozo' => 4,
                'mesa' => 20,
            );
            $result = $this->Printeable->PrintReceiptTicket($data, 'barra');
                        
            $this->assertEqual($result, true);
        }
        
        
}
