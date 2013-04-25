<?php
App::uses('IvaResponsabilidadesController', 'Controller');

/**
 * TestIvaResponsabilidadesController *
 */
class TestIvaResponsabilidadesController extends IvaResponsabilidadesController {
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
 * IvaResponsabilidadesController Test Case
 *
 */
class IvaResponsabilidadesControllerTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.iva_responsabilidad', 'app.tipo_factura', 'app.egreso', 'app.user', 'app.rol', 'app.cliente', 'app.descuento', 'app.mesa', 'app.mozo', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.grupo_sabor', 'app.grupo_sabores_producto', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.detalle_sabor', 'app.pago', 'app.tipo_de_pago', 'app.tipo_documento');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->IvaResponsabilidades = new TestIvaResponsabilidadesController();
		$this->IvaResponsabilidades->constructClasses();
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IvaResponsabilidades);

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
