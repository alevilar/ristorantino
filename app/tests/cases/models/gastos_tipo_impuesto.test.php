<?php 
/* SVN FILE: $Id$ */
/* GastosTipoImpuesto Test cases generated on: 2011-07-19 19:25:40 : 1311114340*/
App::import('Model', 'GastosTipoImpuesto');

class GastosTipoImpuestoTestCase extends CakeTestCase {
	var $GastosTipoImpuesto = null;
	var $fixtures = array('app.gastos_tipo_impuesto', 'app.gasto', 'app.tipo_impuesto');

	function startTest() {
		$this->GastosTipoImpuesto =& ClassRegistry::init('GastosTipoImpuesto');
	}

	function testGastosTipoImpuestoInstance() {
		$this->assertTrue(is_a($this->GastosTipoImpuesto, 'GastosTipoImpuesto'));
	}

	function testGastosTipoImpuestoFind() {
		$this->GastosTipoImpuesto->recursive = -1;
		$results = $this->GastosTipoImpuesto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('GastosTipoImpuesto' => array(
			'id' => 1,
			'gasto_id' => 1,
			'tipo_impuesto_id' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>