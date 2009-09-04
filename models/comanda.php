<?php
class Comanda extends AppModel {

	var $name = 'Comanda';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'DetalleComanda' => array('className' => 'DetalleComanda',
								'foreignKey' => 'comanda_id',
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