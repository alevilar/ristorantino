<?php
App::uses('Tag', 'Model');

/**
 * Tag Test Case
 *
 */
class TagTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.tag', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.detalle_comanda', 'app.comanda', 'app.mesa', 'app.mozo', 'app.user', 'app.rol', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.egreso', 'app.tipo_factura', 'app.pago', 'app.tipo_de_pago', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.productos_tag');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tag = ClassRegistry::init('Tag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tag);

		parent::tearDown();
	}

}
