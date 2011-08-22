<?php 
/* SVN FILE: $Id$ */
/* GastosTipoImpuesto Fixture generated on: 2011-07-19 19:25:40 : 1311114340*/

class GastosTipoImpuestoFixture extends CakeTestFixture {
	var $name = 'GastosTipoImpuesto';
	var $table = 'gastos_tipo_impuestos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'gasto_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'tipo_impuesto_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'gasto_id' => 1,
		'tipo_impuesto_id' => 1
	));
}
?>