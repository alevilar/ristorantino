<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'username' => array('notempty'),
		'password' => array('notempty'),
		'nombre' => array('notempty'),
		'apellido' => array('notempty'),
		'telefono' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasOne = array(
			'Mozo' => array('className' => 'Mozo',
								'foreignKey' => 'user_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>