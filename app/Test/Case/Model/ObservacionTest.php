<?php
App::uses('Observacion', 'Model');

/**
 * Observacion Test Case
 *
 */
class ObservacionTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.observacion');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Observacion = ClassRegistry::init('Observacion');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Observacion);

		parent::tearDown();
	}

}
