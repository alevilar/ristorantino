<?php 
/* SVN FILE: $Id$ */
/* GastosController Test cases generated on: 2010-03-17 22:38:06 : 1268876286*/
App::import('Controller', 'Gastos');

class TestGastos extends GastosController {
	var $autoRender = false;
}

class GastosControllerTest extends CakeTestCase {
	var $Gastos = null;

	function startTest() {
		$this->Gastos = new TestGastos();
		$this->Gastos->constructClasses();
	}

	function testGastosControllerInstance() {
		$this->assertTrue(is_a($this->Gastos, 'GastosController'));
	}

	function endTest() {
		unset($this->Gastos);
	}
}
?>