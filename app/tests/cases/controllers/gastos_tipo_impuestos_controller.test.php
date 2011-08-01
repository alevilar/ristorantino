<?php 
/* SVN FILE: $Id$ */
/* GastosTipoImpuestosController Test cases generated on: 2011-07-19 19:26:02 : 1311114362*/
App::import('Controller', 'GastosTipoImpuestos');

class TestGastosTipoImpuestos extends GastosTipoImpuestosController {
	var $autoRender = false;
}

class GastosTipoImpuestosControllerTest extends CakeTestCase {
	var $GastosTipoImpuestos = null;

	function startTest() {
		$this->GastosTipoImpuestos = new TestGastosTipoImpuestos();
		$this->GastosTipoImpuestos->constructClasses();
	}

	function testGastosTipoImpuestosControllerInstance() {
		$this->assertTrue(is_a($this->GastosTipoImpuestos, 'GastosTipoImpuestosController'));
	}

	function endTest() {
		unset($this->GastosTipoImpuestos);
	}
}
?>