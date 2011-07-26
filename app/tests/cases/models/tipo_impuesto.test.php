<?php 
/* SVN FILE: $Id$ */
/* TipoImpuesto Test cases generated on: 2011-07-19 19:22:38 : 1311114158*/
App::import('Model', 'TipoImpuesto');

class TipoImpuestoTestCase extends CakeTestCase {
	var $TipoImpuesto = null;
	var $fixtures = array('app.tipo_impuesto');

	function startTest() {
		$this->TipoImpuesto =& ClassRegistry::init('TipoImpuesto');
	}

	function testTipoImpuestoInstance() {
		$this->assertTrue(is_a($this->TipoImpuesto, 'TipoImpuesto'));
	}

	function testTipoImpuestoFind() {
		$this->TipoImpuesto->recursive = -1;
		$results = $this->TipoImpuesto->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('TipoImpuesto' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'porcentaje' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>