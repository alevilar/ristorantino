<?php
/**
 * Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2009-2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Mesa', 'Model');
App::uses('ModelBehavior', 'Model');


/**
 * PrinteableTestCase
 *
 */
class PrinteableBehaviorTest extends CakeTestCase {

        public $Mesa;

/**
 * Fixtures used in the SessionTest
 *
 * @var array
 */
	public $fixtures = array('app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.pago', 'app.tipo_de_pago');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Mesa = ClassRegistry::init('Mesa');
	}
/**
 * endTest
 *
 * @return void
 */
	public function endTest() {
		unset($this->Mesa);
	}
        
        
        public function testPublished() {
            $result = $this->Mesa->find('count');
            print_r(    $result );
            pr("asasasasas");
            $this->assertEquals(1, $result);
        }

}
