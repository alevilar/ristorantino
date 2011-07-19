<?php
class Gasto extends AccountAppModel {

	var $name = 'Gasto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'Cliente' => array(
			'className' => 'Cliente',
			'foreignKey' => 'cliente_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'TipoFactura' => array(
			'className' => 'TipoFactura',
			'foreignKey' => 'tipo_factura_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}
?>