<?php 
/* SVN FILE: $Id$ */
/* MesaEstado Fixture generated on: 2011-08-19 23:46:18 : 1313808378*/

class MesaEstadoFixture extends CakeTestFixture {
	var $name = 'MesaEstado';
	var $table = 'mesa_estados';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'created' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
		'lft' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'rght' => array('type'=>'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'parent_id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'created' => 'Lorem ipsum dolor sit amet',
		'modified' => 'Lorem ipsum dolor sit amet',
		'lft' => 1,
		'rght' => 1
	));
}
?>