<?php
/**
 * IvaResponsabilidadFixture
 *
 */
class IvaResponsabilidadFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 24, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'tipo_factura_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
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
			'codigo_fiscal' => 'Lorem ipsum dolor sit ame',
			'name' => 'Lorem ipsum dolor sit ',
			'tipo_factura_id' => 1
		),
	);
}
