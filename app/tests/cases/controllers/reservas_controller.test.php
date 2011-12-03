<?php 
/* SVN FILE: $Id$ */
/* ReservasController Test cases generated on: 2011-12-03 13:02:54 : 1322928174*/
App::import('Controller', 'Reservas');

class TestReservas extends ReservasController {
	var $autoRender = false;
}

class ReservasControllerTest extends CakeTestCase {
	var $Reservas = null;

	function startTest() {
		$this->Reservas = new TestReservas();
		$this->Reservas->constructClasses();
	}

	function testReservasControllerInstance() {
		$this->assertTrue(is_a($this->Reservas, 'ReservasController'));
	}

	function endTest() {
		unset($this->Reservas);
	}
}
?>