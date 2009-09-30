<?php
class Impfiscal extends AppModel {

	var $name = 'Impfiscal';
	var $validate = array(
		'name' => array('notempty'),
		'path' => array('notempty')
	);

}
?>