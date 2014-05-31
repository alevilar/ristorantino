<?php 
/* SVN FILE: $Id$ */
/* TipoDocumentosController Test cases generated on: 2009-12-11 10:54:48 : 1260539688*/
App::import('Controller', 'TipoDocumentos');

class TestTipoDocumentos extends TipoDocumentosController {
	var $autoRender = false;
}

class TipoDocumentosControllerTest extends CakeTestCase {
	var $TipoDocumentos = null;

	function startTest() {
		$this->TipoDocumentos = new TestTipoDocumentos();
		$this->TipoDocumentos->constructClasses();
	}

	function testTipoDocumentosControllerInstance() {
		$this->assertTrue(is_a($this->TipoDocumentos, 'TipoDocumentosController'));
	}

	function endTest() {
		unset($this->TipoDocumentos);
	}
}
?>