<?php 
/* SVN FILE: $Id$ */
/* ProveedoresController Test cases generated on: 2011-07-20 09:13:50 : 1311164030*/
App::import('Controller', 'Proveedores');

class TestProveedores extends ProveedoresController {
	var $autoRender = false;
}

class ProveedoresControllerTest extends CakeTestCase {
	var $Proveedores = null;

	function startTest() {
		$this->Proveedores = new TestProveedores();
		$this->Proveedores->constructClasses();
	}

	function testProveedoresControllerInstance() {
		$this->assertTrue(is_a($this->Proveedores, 'ProveedoresController'));
	}

	function endTest() {
		unset($this->Proveedores);
	}
}
?>