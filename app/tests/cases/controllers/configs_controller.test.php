<?php 
/* SVN FILE: $Id$ */
/* ConfigsController Test cases generated on: 2011-02-17 11:09:25 : 1297951765*/
App::import('Controller', 'Configs');

class TestConfigs extends ConfigsController {
	var $autoRender = false;
}

class ConfigsControllerTest extends CakeTestCase {
	var $Configs = null;

	function startTest() {
		$this->Configs = new TestConfigs();
		$this->Configs->constructClasses();
	}

	function testConfigsControllerInstance() {
		$this->assertTrue(is_a($this->Configs, 'ConfigsController'));
	}

	function endTest() {
		unset($this->Configs);
	}
}
?>