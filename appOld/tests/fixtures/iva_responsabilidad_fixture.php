<?php 
/* SVN FILE: $Id$ */
/* IvaResponsabilidad Fixture generated on: 2009-12-11 11:26:32 : 1260541592*/

class IvaResponsabilidadFixture extends CakeTestFixture {
	var $name = 'IvaResponsabilidad';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 1),
		'name' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 24),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'codigo_fiscal'  => 'Lorem ipsum dolor sit ame',
		'name'  => 1
	));
}
?>