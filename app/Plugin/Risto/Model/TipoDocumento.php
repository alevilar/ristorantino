<?php
App::uses('RistoAppModel', 'Risto.Model');

class TipoDocumento extends RistoAppModel {

	var $name = 'TipoDocumento';
	var $validate = array(
		'codigo_fiscal' => array('notempty'),
		'name' => array('notempty')
	);
	
}
?>