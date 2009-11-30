<?php
class Restaurante extends AppModel {

	var $name = 'Restaurante';
	var $validate = array(
		'name' => array('notempty')
	);

}
?>