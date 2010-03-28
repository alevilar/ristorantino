<?php 
/* SVN FILE: $Id$ */
/* TipoFacturasController Test cases generated on: 2010-03-27 20:01:34 : 1269730894*/
App::import('Controller', 'TipoFacturas');

class TestTipoFacturas extends TipoFacturasController {
	var $autoRender = false;
}

class TipoFacturasControllerTest extends CakeTestCase {
	var $TipoFacturas = null;

	function startTest() {
		$this->TipoFacturas = new TestTipoFacturas();
		$this->TipoFacturas->constructClasses();
	}

	function testTipoFacturasControllerInstance() {
		$this->assertTrue(is_a($this->TipoFacturas, 'TipoFacturasController'));
	}

	function endTest() {
		unset($this->TipoFacturas);
	}
}
?>