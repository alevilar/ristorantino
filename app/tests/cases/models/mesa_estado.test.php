<?php 
/* SVN FILE: $Id$ */
/* MesaEstado Test cases generated on: 2011-08-19 23:46:18 : 1313808378*/
App::import('Model', 'MesaEstado');

class MesaEstadoTestCase extends CakeTestCase {
	var $MesaEstado = null;
	var $fixtures = array('app.mesa_estado', 'app.mesa');

	function startTest() {
		$this->MesaEstado =& ClassRegistry::init('MesaEstado');
	}

	function testMesaEstadoInstance() {
		$this->assertTrue(is_a($this->MesaEstado, 'MesaEstado'));
	}

	function testMesaEstadoFind() {
		$this->MesaEstado->recursive = -1;
		$results = $this->MesaEstado->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('MesaEstado' => array(
			'id' => 1,
			'parent_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 'Lorem ipsum dolor sit amet',
			'modified' => 'Lorem ipsum dolor sit amet',
			'lft' => 1,
			'rght' => 1
		));
		$this->assertEqual($results, $expected);
	}
}
?>