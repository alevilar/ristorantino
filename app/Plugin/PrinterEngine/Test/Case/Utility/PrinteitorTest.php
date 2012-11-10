<?php
App::uses('Printaitor', 'PrinterEngine.Utility');

App::uses('Config','Model');



/**
 * PrinteableBehavior Test Case
 *
 */
class PrintaitorTestCase extends CakeTestCase {
    /**
     *
     * @var Printaitor 
     */
    public $Printaitor;
    
    
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
                        
		parent::setUp();
	}



/**
 * testGetPrinterFileEngine method
 *
 * @return void
 */
	public function testGetPrinterFileEngine() {
            $this->printerOutput = 'file';
            Printaitor::_loadPrinterOutput($this->printerOutput);
            $this->assertEqual($this->printerOutput, strtolower( Printaitor::getEngineName() ) );
	}
        
        
/**
 * testGetPrinterCUPSEngine method
 *
 * @return void
 */
	public function testGetPrinterCUPSEngine() {
            $this->printerOutput = 'cups';
            Printaitor::_loadPrinterOutput($this->printerOutput);
            $this->assertEqual($this->printerOutput, strtolower( Printaitor::getEngineName() ) );
	}
        
        
/**
 * testGetPrinterCUPSEngine method
 *
 * @return void
 */
	public function testGetFiscalPrinterName() {
            $fp = Printaitor::getFiscalPrinter();
            // gets the printer name configured in setup 
            $this->assertEqual($fp['name'], 'Fiscal');
            $this->assertEqual($fp['driver_name'], 'Hasar441');
	}  
        
        
        
        public function testIsFiscal() {
            $fp = Printaitor::getFiscalPrinter();
            // gets the printer name configured in setup 
            $this->assertEqual(Printaitor::_isFiscal('Fiscal'), true);
            $this->assertEqual(Printaitor::_isFiscal('barra'), false);
            $this->assertEqual(Printaitor::_isReceipt('barra'), true);
            $this->assertEqual(Printaitor::_isReceipt('Fiscal'), false);
            $this->assertEqual(Printaitor::_isReceipt('cocina'), true);
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
            $result = Printaitor::send($data, 'barra', 'comandas');
                        
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
            
            $result = Printaitor::send($data, 'barra', 'ticket');
                        
            $this->assertEqual($result, true);
        }
        
        
        public function testPrintFiscalTicket() {
            $data = array(
                'items' => array(),
                'porcentaje_descuento' => 10,
                'total' => 100,
                'mozo' => 4,
                'mesa' => 20,
                'tipo_factura' => "A",
            );
            
            $result = Printaitor::send($data, 'Fiscal', 'ticket');
                        
            $this->assertEqual($result, true);
        }
        
}
