<?php

class PrintersSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
            return true;
	}


	public $printers = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'printer_driver_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'alias' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		);

/**
 * Con que impresora imprimir determinado evento
 * Ej.  Model.Mesa.cerrar -> imprimir con impresora id 2 ("fiscal")
 *		Model.Comanda.add -> imprimir con impresora id 3 (comandera "cocina")
 */
	public $printer_events = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'printer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
			'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		);


/**
 * View Helper a utilizar 
 * La vista a utilizar depende del nombre de este driver y del tipo de impresora printer_type
 * EJ: Bematech, Hasar 441, Hasar 1120+, etc.
 */
	public $printer_drivers = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'printer_type_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10),
			'printer_output_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
			'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		);

/**
 * View Folder a utilizar, segun tipo de impresora 
 * EJ: de comandas, fiscal
 */
	public $printer_types = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		);


/**
 * OutputEngine 
 * EJ: cups, file
 */
	public $printer_outputs = array(
			'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 32),
			'description' => array('type' => 'text', 'null' => false, 'default' => NULL),
			'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		);
}