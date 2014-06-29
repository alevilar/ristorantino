<?php


/*
 *
 * Using the Schema command line utility
 * 
 * copy this file into /app/Config/Schema and
 * run from console:
 * cake schema create reservations
 *
 */
class ReservationsSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

/**
 * Reservations - Table for holding reservations
 */
	public $hotel_reservations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'observation' => array('type' => 'text', 'null' => true, 'default' => null),
		'passengers' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'checkin' => array('type' => 'datetime', 'null' => false),
		'checkout' => array('type' => 'datetime', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);



	/**
	 * Rooms - Table for each room in hotel
	 */
	public $hotel_rooms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true),
		'price' => array('type' => 'decimal', 'length' => '8,4', 'null' => false, 'default' => 0),
		'description' => array('type' => 'text', 'null' => true, 'default' => null),
		'room_state_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);


	/**
	 * Room States - The room shuld belong to one of this states- Ex: Occupied, 
	 */
	public $hotel_room_states = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);


}
