<?php
App::uses('IvaResponsabilidad', 'Model');

/**
 * IvaResponsabilidad Test Case
 *
 */
class IvaResponsabilidadTestCase extends CakeTestCase {
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
		$this->IvaResponsabilidad = ClassRegistry::init('IvaResponsabilidad');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->IvaResponsabilidad);

		parent::tearDown();
	}

}
