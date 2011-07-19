<?php
class TipoImpuesto extends AppModel {

	var $name = 'TipoImpuesto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
		'Gasto' => array(
			'className' => 'Gasto',
			'joinTable' => 'gastos_tipo_impuestos',
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