<?php 
/* SVN FILE: $Id$ */
/* CajasController Test cases generated on: 2013-10-26 13:03:21 : 1382803401*/
App::import('Controller', 'Cash.Cajas');

class TestCajas extends CajasController {
	var $autoRender = false;
}

class CajasControllerTest extends CakeTestCase {
	var $Cajas = null;

	function startTest() {
		$this->Cajas = new TestCajas();
		$this->Cajas->constructClasses();
	}

	function testCajasControllerInstance() {
		$this->assertTrue(is_a($this->Cajas, 'CajasController'));
	}

	function endTest() {
		unset($this->Cajas);
	}
}
?>