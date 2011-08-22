<?php
class MesaEstado extends AppModel {

	var $name = 'MesaEstado';
        
        var $actAs = array('SoftDeletable','actsAs');
        
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Mesa' => array(
			'className' => 'Mesa',
			'foreignKey' => 'mesa_estado_id',
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