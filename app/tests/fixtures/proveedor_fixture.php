<?php 
/* SVN FILE: $Id$ */
/* Proveedor Fixture generated on: 2011-07-20 09:13:32 : 1311164012*/

class ProveedorFixture extends CakeTestFixture {
	var $name = 'Proveedor';
	var $table = 'proveedores';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'cuit' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 12),
		'mail' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'telefono' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'domicilio' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'cuit' => 'Lorem ipsu',
		'mail' => 'Lorem ipsum dolor sit amet',
		'telefono' => 'Lorem ipsum dolor sit amet',
		'domicilio' => 'Lorem ipsum dolor sit amet',
		'created' => '2011-07-20 09:13:32',
		'modified' => '2011-07-20 09:13:32'
	));
}
?>