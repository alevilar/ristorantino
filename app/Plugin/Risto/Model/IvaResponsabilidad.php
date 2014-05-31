<?php
App::uses('RistoAppModel', 'Risto.Model');

class IvaResponsabilidad extends RistoAppModel {

	var $name = 'IvaResponsabilidad';
	var $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);
	

}
?>