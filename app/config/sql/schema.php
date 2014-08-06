<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2013-05-11 13:05:48 : 1368288948*/
class AppSchema extends CakeSchema {
	var $name = 'App';

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
		'closed' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
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
	var $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1))
	);
	var $cake_sessions = array(
		'id' => array('type' => 'string', 'null' => false, 'key' => 'primary'),
		'data' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'expires' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $categorias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'parent' => array('column' => 'parent_id', 'unique' => 0))
	);
	var $clientes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'codigo' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'mail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'tipofactura' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1),
		'imprime_ticket' => array('type' => 'boolean', 'null' => true, 'default' => '1'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110),
		'nrodocumento' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11),
		'tipodocumento' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1),
		'tipo_documento_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110),
		'responsabilidad_iva' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1),
		'iva_responsabilidad_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'prioridad' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'impresa' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'mesa_id' => array('column' => 'mesa_id', 'unique' => 0))
	);
	var $comanderas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'imprime_ticket' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $comensales = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'cant_mayores' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'cant_menores' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'cant_bebes' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $config_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'config_category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $descuentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'porcentaje' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $detalle_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'cant' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'cant_eliminada' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'comanda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'es_entrada' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'mesa_id_2' => array('column' => 'comanda_id', 'unique' => 0), 'producto_id' => array('column' => 'producto_id', 'unique' => 0))
	);
	var $detalle_sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'detalle_comanda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sabor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $egresos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'tipo_factura_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'iva' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'iibb' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'otros' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'total' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $gastos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200),
		'importe' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $historico_precios = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $impfiscales = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $inventory_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 65),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $inventory_counts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'count' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $inventory_products = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 65),
		'category_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $iva_responsabilidades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 24),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $mesas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'mozo_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'subtotal' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'total' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'menu' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'cant_comensales' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'time_cerro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'time_cobro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'time_cerro' => array('column' => array('time_cerro', 'time_cobro'), 'unique' => 0), 'mozo_id' => array('column' => 'mozo_id', 'unique' => 0), 'numero' => array('column' => 'numero', 'unique' => 0), 'time_cobro' => array('column' => 'time_cobro', 'unique' => 0), 'created' => array('column' => array('time_cerro', 'mozo_id'), 'unique' => 0))
	);
	var $mozos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'activo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'numero' => array('column' => 'numero', 'unique' => 0))
	);
	var $observacion_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $observaciones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'tipo_de_pago_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'valor' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pquery_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $pquery_queries = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 78),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'query' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'ver_online' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'category_id' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'expiration_time' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'columns' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $productos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30),
		'abrev' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 28),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'comandera_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => true, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $productos_precios_futuros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $reservas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'personas' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'mesa' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'observaciones' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'evento' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100),
		'fecha' => array('type' => 'datetime', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $restaurantes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tipo_de_pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 110),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tipo_documentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 24),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tipo_facturas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'key' => 'unique'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'key' => 'unique'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50),
		'role' => array('type' => 'string', 'null' => false, 'default' => 'invitado', 'length' => 64),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 40),
		'apellido' => array('type' => 'string', 'null' => false, 'default' => '\'\'', 'length' => 40),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'domicilio' => array('type' => 'string', 'null' => false, 'default' => '\'\'', 'length' => 110),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1))
	);
}
?>