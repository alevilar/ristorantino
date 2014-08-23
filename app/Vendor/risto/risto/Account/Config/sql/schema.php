<?php

class AccountSchema extends CakeSchema {

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $account_clasificaciones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_egresos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'total' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'file' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'tipo_de_pago_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_egresos_gastos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'egreso_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'importe' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_gastos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'cierre_id' => array('type' => 'integer', 'null' => true, 'length' => 4),
		'proveedor_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'clasificacion_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'tipo_factura_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'factura_nro' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 50),
		'fecha' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'importe_neto' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2'),
		'importe_total' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'file' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_gastos_tipo_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tipo_impuesto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'importe' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'gasto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tipo_impuesto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'neto' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'importe' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_proveedores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'cuit' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 12),
		'mail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 100),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $account_tipo_impuestos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'porcentaje' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '6,2'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
        
        var $account_cierres = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
        
        
        
}