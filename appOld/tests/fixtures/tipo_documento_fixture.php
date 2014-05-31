<?php 
/* SVN FILE: $Id$ */
/* TipoDocumento Fixture generated on: 2009-12-11 10:54:48 : 1260539688*/

class TipoDocumentoFixture extends CakeTestFixture {
	var $name = 'TipoDocumento';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 1),
		'name' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 24),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id'  => 1,
		'codigo_fiscal'  => 'Lorem ipsum dolor sit ame',
		'name'  => 'Lorem ipsum dolor sit '
	));
}
?>