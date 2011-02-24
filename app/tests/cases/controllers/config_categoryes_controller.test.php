<?php 
/* SVN FILE: $Id$ */
/* ConfigCategoryesController Test cases generated on: 2011-02-17 11:09:37 : 1297951777*/
App::import('Controller', 'ConfigCategoryes');

class TestConfigCategoryes extends ConfigCategoryesController {
	var $autoRender = false;
}

class ConfigCategoryesControllerTest extends CakeTestCase {
	var $ConfigCategoryes = null;

	function startTest() {
		$this->ConfigCategoryes = new TestConfigCategoryes();
		$this->ConfigCategoryes->constructClasses();
	}

	function testConfigCategoryesControllerInstance() {
		$this->assertTrue(is_a($this->ConfigCategoryes, 'ConfigCategoryesController'));
	}

	function endTest() {
		unset($this->ConfigCategoryes);
	}
}
?>