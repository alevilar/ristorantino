<?php
class IvaResponsabilidad extends AppModel {

	var $name = 'IvaResponsabilidad';
	var $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);
	
	var $hasMany = array(
			'Cliente'
	);

}
?>