<?php
App::uses('RistoAppModel', 'Risto.Model');

class Restaurante extends RistoAppModel {

	var $name = 'Restaurante';
	var $validate = array(
		'name' => array('notempty')
	);

}
?>