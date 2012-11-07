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
	public $fixtures = array('app.mesa', 'app.mozo', 'app.cliente', 'app.descuento', 'app.iva_responsabilidad', 'app.tipo_documento', 'app.comanda', 'app.detalle_comanda', 'app.producto', 'app.categoria', 'app.sabor', 'app.detalle_sabor', 'app.comandera', 'app.productos_precios_futuro', 'app.historico_precio', 'app.tag', 'app.productos_tag', 'app.pago', 'app.tipo_de_pago');

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

/**
 * testGetMozoNumero method
 *
 * @return void
 */
	public function testGetMozoNumero() {

	}
/**
 * testCerrarMesa method
 *
 * @return void
 */
	public function testCerrarMesa() {

	}
/**
 * testCalcularTotalProductos method
 *
 * @return void
 */
	public function testCalcularTotalProductos() {

	}
/**
 * testCalcularDescuentos method
 *
 * @return void
 */
	public function testCalcularDescuentos() {

	}
/**
 * testCalcularTotales method
 *
 * @return void
 */
	public function testCalcularTotales() {

	}
/**
 * testGetImporteDescuento method
 *
 * @return void
 */
	public function testGetImporteDescuento() {

	}
/**
 * testGetPorcentaeDescuento method
 *
 * @return void
 */
	public function testGetPorcentaeDescuento() {

	}
/**
 * testGetSubtotal method
 *
 * @return void
 */
	public function testGetSubtotal() {

	}
/**
 * testGetTotal method
 *
 * @return void
 */
	public function testGetTotal() {

	}
/**
 * testListadoDeProductos method
 *
 * @return void
 */
	public function testListadoDeProductos() {

	}
/**
 * testUltimasCobradas method
 *
 * @return void
 */
	public function testUltimasCobradas() {

	}
/**
 * testListadoDeAbiertas method
 *
 * @return void
 */
	public function testListadoDeAbiertas() {

	}
/**
 * testListadoAbiertasYSinCobrar method
 *
 * @return void
 */
	public function testListadoAbiertasYSinCobrar() {

	}
/**
 * testNumeroDeMesaExistente method
 *
 * @return void
 */
	public function testNumeroDeMesaExistente() {

	}
/**
 * testGetNumero method
 *
 * @return void
 */
	public function testGetNumero() {

	}
/**
 * testGetProductosSinDescripcion method
 *
 * @return void
 */
	public function testGetProductosSinDescripcion() {

	}
/**
 * testDameProductosParaTicket method
 *
 * @return void
 */
	public function testDameProductosParaTicket() {

	}
/**
 * testTodasLasCerradas method
 *
 * @return void
 */
	public function testTodasLasCerradas() {

	}
/**
 * testEstaCerrada method
 *
 * @return void
 */
	public function testEstaCerrada() {

	}
/**
 * testEstaAbiertaPeroNoEsReabierta method
 *
 * @return void
 */
	public function testEstaAbiertaPeroNoEsReabierta() {

	}
/**
 * testEstaAbierta method
 *
 * @return void
 */
	public function testEstaAbierta() {

	}
/**
 * testReabrir method
 *
 * @return void
 */
	public function testReabrir() {

	}
/**
 * testTotalesDeMesasEntre method
 *
 * @return void
 */
	public function testTotalesDeMesasEntre() {

	}
/**
 * testGetDataParaFiscal method
 *
 * @return void
 */
	public function testGetDataParaFiscal() {

	}
/**
 * testImprimirTicket method
 *
 * @return void
 */
	public function testImprimirTicket() {

	}
}
