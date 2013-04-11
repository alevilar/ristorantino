<?php
App::uses('GrupoSabor', 'Model');

/**
 * GrupoSabor Test Case
 *
 */
class GrupoSaborTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.grupo_sabor', 'app.producto', 'app.categoria', 'app.sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.detalle_comanda', 'app.comanda', 'app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.pago', 'app.tipo_de_pago', 'app.detalle_sabor', 'app.tag', 'app.productos_tag', 'app.productos_grupo_sabor');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->GrupoSabor = ClassRegistry::init('GrupoSabor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->GrupoSabor);

		parent::tearDown();
	}

}
