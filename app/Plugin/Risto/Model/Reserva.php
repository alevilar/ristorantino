<?php
App::uses('RistoAppModel', 'Risto.Model');

class Reserva extends RistoAppModel {

	var $name = 'Reserva';
	var $validate = array(
		'nombre' => array('notempty'),
		'personas' => array('numeric')
	);

}
?>