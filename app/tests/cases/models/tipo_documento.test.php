<?php 
/* SVN FILE: $Id$ */
/* TipoDocumento Test cases generated on: 2009-12-11 10:54:48 : 1260539688*/
App::import('Model', 'TipoDocumento');

class TipoDocumentoTestCase extends CakeTestCase {
	var $TipoDocumento = null;
	var $fixtures = array('app.tipo_documento');

	function startTest() {
		$this->TipoDocumento =& ClassRegistry::init('TipoDocumento');
	}

	function testTipoDocumentoInstance() {
		$this->assertTrue(is_a($this->TipoDocumento, 'TipoDocumento'));
	}

	function testTipoDocumentoFind() {
		$this->TipoDocumento->recursive = -1;
		$results = $this->TipoDocumento->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('TipoDocumento' => array(
			'id'  => 1,
			'codigo_fiscal'  => 'Lorem ipsum dolor sit ame',
			'name'  => 'Lorem ipsum dolor sit '
		));
		$this->assertEqual($results, $expected);
	}
}
?>