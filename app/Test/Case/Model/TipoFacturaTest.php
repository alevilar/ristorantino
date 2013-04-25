<?php
App::uses('TipoFactura', 'Model');

/**
 * TipoFactura Test Case
 *
 */
class TipoFacturaTestCase extends CakeTestCase {
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
		$this->TipoFactura = ClassRegistry::init('TipoFactura');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TipoFactura);

		parent::tearDown();
	}

}
