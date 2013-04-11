<?php
/**
 * GrupoSaborFixture
 *
 */
class GrupoSaborFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'seleccion_de_sabor_obligatorio' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
		'tipo_de_seleccion' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
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
			'seleccion_de_sabor_obligatorio' => 1,
			'tipo_de_seleccion' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'created' => 1365637923,
			'modified' => 1365637923
		),
	);
}
