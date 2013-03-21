<?php 
/* SVN FILE: $Id$ */
/* AccountClasificacion Test cases generated on: 2013-03-13 02:14:09 : 1363151649*/
App::import('Model', 'AccountClasificacion');

class AccountClasificacionTestCase extends CakeTestCase {
	var $AccountClasificacion = null;
	var $fixtures = array('app.account_clasificacion');

	function startTest() {
		$this->AccountClasificacion =& ClassRegistry::init('AccountClasificacion');
	}

	function testAccountClasificacionInstance() {
		$this->assertTrue(is_a($this->AccountClasificacion, 'AccountClasificacion'));
	}

	function testAccountClasificacionFind() {
		$this->AccountClasificacion->recursive = -1;
		$results = $this->AccountClasificacion->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('AccountClasificacion' => array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet'
		));
		$this->assertEqual($results, $expected);
	}
}
?>