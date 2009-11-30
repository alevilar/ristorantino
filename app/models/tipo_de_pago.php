<?php
class TipoDePago extends AppModel {

	var $name = 'TipoDePago';
	var $validate = array(
		'name' => array('notempty')
	);


	var $hasMany = array(
			'Pago' => array('className' => 'Pago',
								'foreignKey' => 'tipo_de_pago_id',
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