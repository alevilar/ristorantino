<?php
App::uses('User', 'Model');

/**
 * User Test Case
 *
 */
class UserTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.user', 'app.rol', 'app.cliente', 'app.descuento', 'app.mesa', 'app.mozo', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.pago', 'app.tipo_de_pago', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.egreso', 'app.tipo_factura');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->User = ClassRegistry::init('User');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->User);

		parent::tearDown();
	}

}
