<?php 
/* SVN FILE: $Id$ */
/* Gasto Test cases generated on: 2011-07-19 16:33:38 : 1311104018*/
App::import('Model', 'Gasto');

class GastoTestCase extends CakeTestCase {
	var $Gasto = null;
	var $fixtures = array('app.gasto', 'app.cliente', 'app.tipo_factura');

	function startTest() {
		$this->Gasto =& ClassRegistry::init('Gasto');
	}

	function testGastoInstance() {
		$this->assertTrue(is_a($this->Gasto, 'Gasto'));
	}

	function testGastoFind() {
		$this->Gasto->recursive = -1;
		$results = $this->Gasto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Gasto' => array(
			'id' => 1,
			'cliente_id' => 1,
			'clasificacion' => 'Lorem ipsum dolor sit amet',
			'tipo_factura_id' => 1,
			'factura_nro' => 'Lorem ipsum dolor sit amet',
			'factura_fecha' => '2011-07-19',
			'importe_neto' => 1,
			'iva_a' => 1,
			'iva_b' => 1,
			'iibb' => 1,
			'imp_int' => 1,
			'percep_iva' => 1,
			'no_gravado' => 1,
			'otros' => 1,
			'created' => '2011-07-19 16:33:38',
			'modified' => '2011-07-19 16:33:38'
		));
		$this->assertEqual($results, $expected);
	}
}
?>