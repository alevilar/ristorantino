<?php
class Descuento extends AppModel {

	var $name = 'Descuento';
	var $validate = array(
		'name' => array('notempty'),
		'porcentaje' => array(
            'numeric' => array(
                'rule' => 'numeric',
                'required' => true,
                'message' => 'Solo números'
                )
        )
	);



	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Cliente' => array('className' => 'Cliente',
								'foreignKey' => 'descuento_id',
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