<?php
App::uses('Mesa', 'Model');

/**
 * Mesa Test Case
 *
 */
class MesaTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.estado', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.grupo_sabor', 'app.grupo_sabores_producto', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.detalle_sabor', 'app.pago', 'app.tipo_de_pago');

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
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Mesa);

		parent::tearDown();
	}

}
