<?php
class Proveedor extends AccountAppModel {

	var $name = 'Proveedor';
        var $order = array('Proveedor.name' => 'ASC');
        
        var $validate = array(
		'name' => array(
			'rule1' => array(
				'rule' => array('minLength', '1'),
				'required' => true,
				'message' => 'Debe especificar un nombre'
			)
		)
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Gasto' => array(
			'className' => 'Account.Gasto',
			'foreignKey' => 'proveedor_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

}
?>