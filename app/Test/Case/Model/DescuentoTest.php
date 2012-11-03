<?php
App::uses('Descuento', 'Model');

/**
 * Descuento Test Case
 *
 */
class DescuentoTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.descuento', 'app.cliente', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.mesa', 'app.mozo', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.pago', 'app.tipo_de_pago');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Descuento = ClassRegistry::init('Descuento');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Descuento);

		parent::tearDown();
	}

}
