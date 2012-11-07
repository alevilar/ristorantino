<?php
App::uses('Comandera', 'Model');

/**
 * Comandera Test Case
 *
 */
class ComanderaTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.comandera', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.detalle_comanda', 'app.comanda', 'app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.pago', 'app.tipo_de_pago', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Comandera = ClassRegistry::init('Comandera');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Comandera);

		parent::tearDown();
	}

}
