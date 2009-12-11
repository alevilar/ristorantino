<?php 
/* SVN FILE: $Id$ */
/* IvaResponsabilidadesController Test cases generated on: 2009-12-11 11:26:32 : 1260541592*/
App::import('Controller', 'IvaResponsabilidades');

class TestIvaResponsabilidades extends IvaResponsabilidadesController {
	var $autoRender = false;
}

class IvaResponsabilidadesControllerTest extends CakeTestCase {
	var $IvaResponsabilidades = null;

	function startTest() {
		$this->IvaResponsabilidades = new TestIvaResponsabilidades();
		$this->IvaResponsabilidades->constructClasses();
	}

	function testIvaResponsabilidadesControllerInstance() {
		$this->assertTrue(is_a($this->IvaResponsabilidades, 'IvaResponsabilidadesController'));
	}

	function endTest() {
		unset($this->IvaResponsabilidades);
	}
}
?>