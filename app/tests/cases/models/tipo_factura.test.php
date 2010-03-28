<?php 
/* SVN FILE: $Id$ */
/* TipoFactura Test cases generated on: 2010-03-27 20:00:28 : 1269730828*/
App::import('Model', 'TipoFactura');

class TipoFacturaTestCase extends CakeTestCase {
	var $TipoFactura = null;
	var $fixtures = array('app.tipo_factura', 'app.egreso');

	function startTest() {
		$this->TipoFactura =& ClassRegistry::init('TipoFactura');
	}

	function testTipoFacturaInstance() {
		$this->assertTrue(is_a($this->TipoFactura, 'TipoFactura'));
	}

	function testTipoFacturaFind() {
		$this->TipoFactura->recursive = -1;
		$results = $this->TipoFactura->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('TipoFactura' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 'Lorem ipsum dolor sit amet',
			'modified' => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>