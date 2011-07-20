<?php
class GastosTipoImpuesto extends AppModel {

	var $name = 'GastosTipoImpuesto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Gasto' => array(
			'className' => 'Gasto',
			'foreignKey' => 'gasto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TipoImpuesto' => array(
			'className' => 'TipoImpuesto',
			'foreignKey' => 'tipo_impuesto_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>