<?php
class Pago extends AppModel {

	var $name = 'Pago';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'mesa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'TipoDePago' => array('className' => 'TipoDePago',
								'foreignKey' => 'tipo_de_pago_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>