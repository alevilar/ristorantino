<?php 
class AppSchema extends CakeSchema {
        
	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
            return true;
	}

	public $acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $aros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'model' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'foreign_key' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'alias' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $aros_acos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'aro_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'aco_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'_create' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'_read' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'_update' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'_delete' => array('type' => 'string', 'null' => false, 'default' => '0', 'length' => 2, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'ARO_ACO_KEY' => array('column' => array('aro_id', 'aco_id'), 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $categorias = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'parent_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'lft' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'rght' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'parent' => array('column' => 'parent_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $clientes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'codigo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'tipofactura' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nrodocumento' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'tipo_documento_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'responsabilidad_iva' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'comment' => 'ver el listado de posibilidades de CHARs para la responsabilidad del IVA, se pude ver en el codigo fuente, pero es casi un standar', 'charset' => 'utf8'),
		'iva_responsabilidad_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'prioridad' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'impresa' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'mesa_id' => array('column' => 'mesa_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $comanderas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'driver_name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'imprime_ticket' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'me dice si imprime o no tickets factura'),
		'es_impresora' => array('type' => 'boolean', 'null' => false, 'default' => '0', 'comment' => 'me dice si se utiliza como impresora comun, para imprimir informes, remitos, encuestas, etc'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $config_categories = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $configs = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'config_category_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'key' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'value' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $descuentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'porcentaje' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $detalle_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'cant' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 4),
		'cant_eliminada' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'comanda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'observacion' => array('type' => 'text', 'null' => true, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'es_entrada' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'mesa_id_2' => array('column' => 'comanda_id', 'unique' => 0), 'producto_id' => array('column' => 'producto_id', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $detalle_sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'detalle_comanda_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'sabor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $egresos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'tipo_factura_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'iva' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'iibb' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'otros' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'total' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '10,2'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $fiscal_printers = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'driver' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'path' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $historico_precios = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $iva_responsabilidades = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 24, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $mesas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'mozo_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'index'),
		'subtotal' => array('type' => 'float', 'null' => false, 'default' => '0'),
		'total' => array('type' => 'float', 'null' => true, 'default' => '0.00', 'length' => '10,2'),
		'cliente_id' => array('type' => 'integer', 'null' => true, 'default' => '0', 'length' => 10),
		'menu' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4, 'comment' => 'es para cuando un cliente quiere imprimir el importe como MENU sin que se vea lo que consumio'),
		'cant_comensales' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'estado_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'descuento_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'time_cerro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'time_cobro' => array('type' => 'timestamp', 'null' => false, 'default' => '0000-00-00 00:00:00', 'key' => 'index'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'time_cerro' => array('column' => array('time_cerro', 'time_cobro'), 'unique' => 0), 'mozo_id' => array('column' => 'mozo_id', 'unique' => 0), 'numero' => array('column' => 'numero', 'unique' => 0), 'time_cobro' => array('column' => 'time_cobro', 'unique' => 0), 'created' => array('column' => array('time_cerro', 'mozo_id'), 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $mozos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'apellido' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 10),
		'numero' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'activo' => array('type' => 'boolean', 'null' => false, 'default' => '0'),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'numero' => array('column' => 'numero', 'unique' => 0)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $observacion_comandas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $observaciones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'mesa_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'tipo_de_pago_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'valor' => array('type' => 'float', 'null' => false, 'default' => NULL, 'comment' => 'por ahora este campo vale cuando el tipo de pago es mixto, entonces se pone la cantidad de efectivo que pag�. Para poder hacer el arqueo.'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $productos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'abrev' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 28, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'description' => array('type' => 'text', 'null' => false, 'default' => NULL, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL, 'length' => '10,2'),
		'comandera_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => false, 'default' => '0'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $productos_precios_futuros = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $productos_tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $restaurantes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 60, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $roles = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'machin_name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
        
        public $grupo_sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'seleccion_de_sabor_obligatorio' => array('type' => 'boolean', 'null' => false, 'default' => NULL),
                'tipo_de_seleccion' => array('type' => 'integer', 'null' => false, 'default' => NULL),
                'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);        
        
        public $grupo_sabores_productos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
                'producto_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
                'grupo_sabor_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	); 
        
	public $sabores = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'categoria_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
                'grupo_sabor_id'=> array('type' => 'integer', 'null' => false, 'default' => NULL),
		'precio' => array('type' => 'float', 'null' => false, 'default' => NULL),            
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted_date' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 4),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $tags = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'MyISAM')
	);
	public $tipo_de_pagos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'image_url' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $tipo_documentos = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'codigo_fiscal' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 24, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $tipo_facturas = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 100, 'key' => 'unique', 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'name' => array('column' => 'name', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
	public $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'username' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'key' => 'unique', 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'password' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 50, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'rol_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 40, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'apellido' => array('type' => 'string', 'null' => true, 'length' => 40, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'domicilio' => array('type' => 'string', 'null' => true, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'deleted' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'length' => 6),
		'deleted_date' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'username' => array('column' => 'username', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_spanish_ci', 'engine' => 'MyISAM')
	);
                
}
