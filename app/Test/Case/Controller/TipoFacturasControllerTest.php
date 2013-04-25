<?php
App::uses('TipoFacturasController', 'Controller');

/**
 * TestTipoFacturasController *
 */
class TestTipoFacturasController extends TipoFacturasController {
/**
 * Auto render
 *
 * @var boolean
 */
	public $autoRender = false;

/**
 * Redirect action
 *
 * @param mixed $url
 * @param mixed $status
 * @param boolean $exit
 * @return void
 */
	public function redirect($url, $status = null, $exit = true) {
		$this->redirectUrl = $url;
	}
}

/**
 * TipoFacturasController Test Case
 *
 */
class TipoFacturasControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.tipo_factura', 'app.iva_responsabilidad', 'app.cliente', 'app.descuento', 'app.mesa', 'app.mozo', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.grupo_sabor', 'app.grupo_sabores_producto', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.detalle_sabor', 'app.pago', 'app.tipo_de_pago', 'app.tipo_documento');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TipoFacturas = new TestTipoFacturasController();
		$this->TipoFacturas->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoFacturas);

		parent::tearDown();
	}

/**
 * testIndex method
 *
 * @return void
 */
	public function testIndex() {

	}
/**
 * testView method
 *
 * @return void
 */
	public function testView() {

	}
/**
 * testAdd method
 *
 * @return void
 */
	public function testAdd() {

	}
/**
 * testEdit method
 *
 * @return void
 */
	public function testEdit() {

	}
/**
 * testDelete method
 *
 * @return void
 */
	public function testDelete() {

	}
}
