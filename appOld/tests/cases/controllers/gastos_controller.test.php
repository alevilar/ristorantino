<?php 
/* SVN FILE: $Id$ */
/* GastosController Test cases generated on: 2010-03-17 22:38:06 : 1268876286*/
App::import('Controller', 'Egresos');

class TestGastos extends GastosController {
	var $autoRender = false;
}

class GastosControllerTest extends CakeTestCase {
	var $Egresos = null;

	function startTest() {
		$this->Egresos = new TestGastos();
		$this->Egresos->constructClasses();
	}

	function testGastosControllerInstance() {
		$this->assertTrue(is_a($this->Egresos, 'EgresosController'));
	}

	function endTest() {
		unset($this->Egresos);
	}
}
?>