<?php 
/* SVN FILE: $Id$ */
/* TipoImpuesto Fixture generated on: 2011-07-19 19:22:38 : 1311114158*/

class TipoImpuestoFixture extends CakeTestFixture {
	var $name = 'TipoImpuesto';
	var $table = 'tipo_impuestos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'porcentaje' => array('type'=>'float', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'name' => 'Lorem ipsum dolor sit amet',
		'porcentaje' => 1
	));
}
?>