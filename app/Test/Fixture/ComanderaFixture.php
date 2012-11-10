<?php
/**
 * ComanderaFixture
 *
 */
class ComanderaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'driver_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'imprime_ticket' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'me dice si imprime o no tickets factura'),
                'es_impresora' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'me dice si es una impresora comun que imprime otras cosas'), 
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
			'id' => '1',
			'name' => 'barra',
			'description' => 'Impresora de la Barra',
			'driver_name' => 'Bematech',
			'path' => '/tmp/comanderas/barra',
			'imprime_ticket' => 0,
                        'es_impresora' => 1,
		),
		array(
			'id' => '3',
			'name' => 'cocina',
			'description' => 'Comandera de la Cocina',
			'driver_name' => 'EscP',
			'path' => '/tmp/comanderas/cocina',
			'imprime_ticket' => 0,
                        'es_impresora' => 0,
		),
		array(
			'id' => '4',
			'name' => 'Fiscal',
			'description' => 'impresorita linda blanquita',
			'driver_name' => 'Hasar441',
			'path' => '/tmp/impresorafiscal',
			'imprime_ticket' => 1,
                        'es_impresora' => 0,
		)
	);
}
