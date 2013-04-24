<?php
/**
 * MesaFixture
 *
 */
class MesaFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'mozo_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'subtotal' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'total' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'menu' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio'),
		'cant_comensales' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'time_cerro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'time_cobro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'time_cerro' => array('column' => array('time_cerro', 'time_cobro'), 'unique' => 0), 'mozo_id' => array('column' => 'mozo_id', 'unique' => 0), 'numero' => array('column' => 'numero', 'unique' => 0), 'time_cobro' => array('column' => 'time_cobro', 'unique' => 0), 'created' => array('column' => array('time_cerro', 'mozo_id'), 'unique' => 0)),
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
			'numero' => 1,
			'mozo_id' => 1,
			'subtotal' => 1,
			'total' => 1,
			'cliente_id' => 1,
			'menu' => 1,
			'cant_comensales' => 1,
			'estado_id' => 1,
			'descuento_id' => 1,
			'created' => 1366776023,
			'modified' => 1366776023,
			'time_cerro' => 1366776023,
			'time_cobro' => 1366776023,
			'deleted_date' => 1366776023,
			'deleted' => 1
		),
	);
}
