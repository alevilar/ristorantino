<?php
App::uses('RistoAppModel', 'Risto.Model');

class TipoDePago extends RistoAppModel {

	var $name = 'TipoDePago';
	var $validate = array(
		'name' => array('notempty')
	);


}
?>