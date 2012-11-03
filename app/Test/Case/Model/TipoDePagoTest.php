<?php
App::uses('TipoDePago', 'Model');

/**
 * TipoDePago Test Case
 *
 */
class TipoDePagoTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.tipo_de_pago', 'app.pago', 'app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TipoDePago = ClassRegistry::init('TipoDePago');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoDePago);

		parent::tearDown();
	}

}
