<?php 
/* SVN FILE: $Id$ */
/* TipoImpuestosController Test cases generated on: 2011-07-19 19:24:18 : 1311114258*/
App::import('Controller', 'TipoImpuestos');

class TestTipoImpuestos extends TipoImpuestosController {
	var $autoRender = false;
}

class TipoImpuestosControllerTest extends CakeTestCase {
	var $TipoImpuestos = null;

	function startTest() {
		$this->TipoImpuestos = new TestTipoImpuestos();
		$this->TipoImpuestos->constructClasses();
	}

	function testTipoImpuestosControllerInstance() {
		$this->assertTrue(is_a($this->TipoImpuestos, 'TipoImpuestosController'));
	}

	function endTest() {
		unset($this->TipoImpuestos);
	}
}
?>