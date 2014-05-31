<?php
/**
 * ClienteFixture
 *
 */
class ClienteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'unsigned' => true, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 30, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10, 'unsigned' => true),
		'tipofactura' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nrodocumento' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 11, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'tipo_documento_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'responsabilidad_iva' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'comment' => 'ver el listado de posibilidades de CHARs para la responsabilidad del IVA, se pude ver en el codigo fuente, pero es casi un standar', 'charset' => 'utf8'),
		'iva_responsabilidad_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
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
			'codigo' => 'Lorem ipsum dolor sit amet',
			'mail' => 'Lorem ipsum dolor sit amet',
			'telefono' => 'Lorem ipsum dolor sit amet',
			'descuento_id' => 1,
			'tipofactura' => 'Lorem ipsum dolor sit ame',
			'nombre' => 'Lorem ipsum dolor sit amet',
			'nrodocumento' => 'Lorem ips',
			'tipo_documento_id' => 1,
			'domicilio' => 'Lorem ipsum dolor sit amet',
			'responsabilidad_iva' => 'Lorem ipsum dolor sit ame',
			'iva_responsabilidad_id' => 1,
			'created' => 1399169874,
			'modified' => 1399169874
		),
	);

}
