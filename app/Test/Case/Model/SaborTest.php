<?php
App::uses('Sabor', 'Model');

/**
 * Sabor Test Case
 *
 */
class SaborTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.sabor', 'app.categoria', 'app.producto', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.detalle_comanda', 'app.comanda', 'app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.pago', 'app.tipo_de_pago', 'app.detalle_sabor', 'app.tag', 'app.productos_tag', 'app.detalle');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Sabor = ClassRegistry::init('Sabor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Sabor);

		parent::tearDown();
	}

}
