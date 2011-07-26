<?php 
/* SVN FILE: $Id$ */
/* Proveedor Test cases generated on: 2011-07-20 09:13:32 : 1311164012*/
App::import('Model', 'Proveedor');

class ProveedorTestCase extends CakeTestCase {
	var $Proveedor = null;
	var $fixtures = array('app.proveedor', 'app.gasto');

	function startTest() {
		$this->Proveedor =& ClassRegistry::init('Proveedor');
	}

	function testProveedorInstance() {
		$this->assertTrue(is_a($this->Proveedor, 'Proveedor'));
	}

	function testProveedorFind() {
		$this->Proveedor->recursive = -1;
		$results = $this->Proveedor->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Proveedor' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'cuit' => 'Lorem ipsu',
			'mail' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'domicilio' => 'Lorem ipsum dolor sit amet',
			'created' => '2011-07-20 09:13:32',
			'modified' => '2011-07-20 09:13:32'
		));
		$this->assertEqual($results, $expected);
	}
}
?>