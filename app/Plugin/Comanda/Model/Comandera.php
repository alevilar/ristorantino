<?php
App::uses('ComandaAppModel', 'Comanda.Model');

class Comandera extends ComandaAppModel {

	var $name = 'Comandera';
	var $validate = array(
		'name' => array('notempty'),
		'description' => array('notempty'),
		'path' => array('notempty'),
		'imprime_ticket' => array('boolean')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Producto' => array('className' => 'Product.Producto',
								'foreignKey' => 'comandera_id',
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