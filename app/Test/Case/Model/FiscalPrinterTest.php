<?php
App::uses('FiscalPrinter', 'Model');

/**
 * FiscalPrinter Test Case
 *
 */
class FiscalPrinterTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.fiscal_printer');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FiscalPrinter = ClassRegistry::init('FiscalPrinter');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FiscalPrinter);

		parent::tearDown();
	}

}
