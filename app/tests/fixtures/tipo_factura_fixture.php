<?php 
/* SVN FILE: $Id$ */
/* TipoFactura Fixture generated on: 2010-03-27 20:00:28 : 1269730828*/

class TipoFacturaFixture extends CakeTestFixture {
	var $name = 'TipoFactura';
	var $table = 'tipo_facturas';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100, 'key' => 'unique'),
		'created' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'created' => 'Lorem ipsum dolor sit amet',
		'modified' => 'Lorem ipsum dolor sit amet'
	));
}
?>