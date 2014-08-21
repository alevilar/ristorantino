<?php
class Comandera extends AppModel {

	var $name = 'Comandera';
	var $validate = array(
		'name' => array('notempty'),
		'imprime_ticket' => array('boolean')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Producto' => array('className' => 'Producto',
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