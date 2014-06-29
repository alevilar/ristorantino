<?php
App::uses('Printer', 'Printers.Model');

/**
 * Printer Test Case
 *
 */
class PrinterTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.printers.printer'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Printer = ClassRegistry::init('Printers.Printer');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Printer);

		parent::tearDown();
	}

}
