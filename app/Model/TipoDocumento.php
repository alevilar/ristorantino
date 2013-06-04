<?php
class TipoDocumento extends AppModel {

	var $name = 'TipoDocumento';
	var $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);
	
	var $hasMany = array(
			'Cliente'
	);

}
?>