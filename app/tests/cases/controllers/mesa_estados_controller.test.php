<?php 
/* SVN FILE: $Id$ */
/* MesaEstadosController Test cases generated on: 2011-08-19 23:46:32 : 1313808392*/
App::import('Controller', 'MesaEstados');

class TestMesaEstados extends MesaEstadosController {
	var $autoRender = false;
}

class MesaEstadosControllerTest extends CakeTestCase {
	var $MesaEstados = null;

	function startTest() {
		$this->MesaEstados = new TestMesaEstados();
		$this->MesaEstados->constructClasses();
	}

	function testMesaEstadosControllerInstance() {
		$this->assertTrue(is_a($this->MesaEstados, 'MesaEstadosController'));
	}

	function endTest() {
		unset($this->MesaEstados);
	}
}
?>