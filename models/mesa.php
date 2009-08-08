<?php
class Mesa extends AppModel {

	var $name = 'Mesa';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mozo' => array('className' => 'Mozo',
								'foreignKey' => 'mozo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Descuento' => array('className' => 'Descuento',
								'foreignKey' => 'descuento_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasOne = array(
			'Comensal' => array('className' => 'Comensal',
								'foreignKey' => 'mesa_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Comanda' => array('className' => 'Comanda',
								'foreignKey' => 'mesa_id',
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