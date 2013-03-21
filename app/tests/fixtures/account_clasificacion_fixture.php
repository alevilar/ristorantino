<?php 
/* SVN FILE: $Id$ */
/* AccountClasificacion Fixture generated on: 2013-03-13 02:14:09 : 1363151649*/

class AccountClasificacionFixture extends CakeTestFixture {
	var $name = 'AccountClasificacion';
	var $table = 'account_clasificaciones';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet'
	));
}
?>