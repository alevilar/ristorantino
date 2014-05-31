<?php 
/* SVN FILE: $Id$ */
/* Cliente Fixture generated on: 2009-10-24 20:10:29 : 1256425229*/

class ClienteFixture extends CakeTestFixture {
	var $name = 'Cliente';
	var $table = 'clientes';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'user_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10),
			'descuento_id' => array('type'=>'integer', 'null' => true, 'default' => '0', 'length' => 10),
			'tipofactura' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1),
			'imprime_ticket' => array('type'=>'boolean', 'null' => true, 'default' => '1'),
			'nombre' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 110),
			'nrodocumento' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 11),
			'tipodocumento' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1),
			'domicilio' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 110),
			'responsabilidad_iva' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 1),
			'created' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type'=>'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'user_id'  => 1,
			'descuento_id'  => 1,
			'tipofactura'  => 'Lorem ipsum dolor sit ame',
			'imprime_ticket'  => 1,
			'nombre'  => 'Lorem ipsum dolor sit amet',
			'nrodocumento'  => 'Lorem ips',
			'tipodocumento'  => 'Lorem ipsum dolor sit ame',
			'domicilio'  => 'Lorem ipsum dolor sit amet',
			'responsabilidad_iva'  => 'Lorem ipsum dolor sit ame',
			'created'  => 'Lorem ipsum dolor sit ame',
			'modified'  => 'Lorem ipsum dolor sit ame'
			));
}
?>