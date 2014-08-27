<?php

App::uses('AccountAppModel', 'Account.Model');


class TipoImpuesto extends AccountAppModel {

	var $name = 'TipoImpuesto';
        var $order = array('TipoImpuesto.name' => 'ASC');
        
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
	var $hasAndBelongsToMany = array(
		'Gasto' => array(
			'className' => 'Account.Gasto',
			'joinTable' => 'account_impuestos',
			'foreignKey' => 'tipo_impuesto_id',
			'associationForeignKey' => 'gasto_id',
			'unique' => true,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'finderQuery' => '',
			'deleteQuery' => '',
			'insertQuery' => ''
		)
	);

}
?>