<?php 
/* SVN FILE: $Id$ */
/* Gasto Fixture generated on: 2011-07-19 16:33:38 : 1311104018*/

class GastoFixture extends CakeTestFixture {
	var $name = 'Gasto';
	var $table = 'gastos';
	var $fields = array(
		'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'cliente_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'clasificacion' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'tipo_factura_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
		'factura_nro' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'factura_fecha' => array('type'=>'date', 'null' => true, 'default' => NULL),
		'importe_neto' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'iva_a' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'iva_b' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'iibb' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'imp_int' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'percep_iva' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'no_gravado' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'otros' => array('type'=>'float', 'null' => false, 'default' => '0'),
		'created' => array('type'=>'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type'=>'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $records = array(array(
		'id' => 1,
		'cliente_id' => 1,
		'clasificacion' => 'Lorem ipsum dolor sit amet',
		'tipo_factura_id' => 1,
		'factura_nro' => 'Lorem ipsum dolor sit amet',
		'factura_fecha' => '2011-07-19',
		'importe_neto' => 1,
		'iva_a' => 1,
		'iva_b' => 1,
		'iibb' => 1,
		'imp_int' => 1,
		'percep_iva' => 1,
		'no_gravado' => 1,
		'otros' => 1,
		'created' => '2011-07-19 16:33:38',
		'modified' => '2011-07-19 16:33:38'
	));
}
?>