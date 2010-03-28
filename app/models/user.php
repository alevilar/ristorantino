<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
	
		'username' => array(
			'required' => VALID_NOT_EMPTY,
			'isUnique' => array(
                            'rule'=>'isUnique',
                            'message' => 'El nombre de usuario ya existe'),
		),
		'password' => array('notempty'),
		'nombre' => array('notempty'),
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