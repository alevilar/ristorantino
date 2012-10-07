<?php
App::uses('Observacione', 'Model');

/**
 * Observacione Test Case
 *
 */
class ObservacioneTestCase extends CakeTestCase {
/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array('app.observacione');

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Observacione = ClassRegistry::init('Observacione');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Observacione);

		parent::tearDown();
	}

}
