<?php
class Reserva extends AppModel {

	var $name = 'Reserva';
	var $validate = array(
		'nombre' => array('notempty'),
		'personas' => array('numeric')
	);

}
?>