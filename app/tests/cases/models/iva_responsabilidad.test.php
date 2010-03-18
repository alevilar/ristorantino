<?php 
/* SVN FILE: $Id$ */
/* IvaResponsabilidad Test cases generated on: 2009-12-11 11:26:32 : 1260541592*/
App::import('Model', 'IvaResponsabilidad');

class IvaResponsabilidadTestCase extends CakeTestCase {
	var $IvaResponsabilidad = null;
	var $fixtures = array('app.iva_responsabilidad');

	function startTest() {
		$this->IvaResponsabilidad =& ClassRegistry::init('IvaResponsabilidad');
	}

	function testIvaResponsabilidadInstance() {
		$this->assertTrue(is_a($this->IvaResponsabilidad, 'IvaResponsabilidad'));
	}

	function testIvaResponsabilidadFind() {
		$this->IvaResponsabilidad->recursive = -1;
		$results = $this->IvaResponsabilidad->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('IvaResponsabilidad' => array(
			'id'  => 1,
			'codigo_fiscal'  => 'Lorem ipsum dolor sit ame',
			'name'  => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>