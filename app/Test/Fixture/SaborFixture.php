<?php
/**
 * SaborFixture
 *
 */
class SaborFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'categoria_id' => 1,
			'precio' => 1,
			'created' => 1352698063,
			'modified' => 1352698063,
			'deleted_date' => 1352698063,
			'deleted' => 1
		),
	);
}
