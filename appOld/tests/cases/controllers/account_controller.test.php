<?php 
/* SVN FILE: $Id$ */
/* AccountController Test cases generated on: 2013-03-13 02:31:58 : 1363152718*/
App::import('Controller', 'Account');

class TestAccount extends AccountController {
	var $autoRender = false;
}

class AccountControllerTest extends CakeTestCase {
	var $Account = null;

	function startTest() {
		$this->Account = new TestAccount();
		$this->Account->constructClasses();
	}

	function testAccountControllerInstance() {
		$this->assertTrue(is_a($this->Account, 'AccountController'));
	}

	function endTest() {
		unset($this->Account);
	}
}
?>