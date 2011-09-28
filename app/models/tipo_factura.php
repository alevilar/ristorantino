<?php
class TipoFactura extends AppModel {

	var $name = 'TipoFactura';
	var $validate = array(
		'name' => array('notempty')
	);
        var $order = 'TipoFactura.name';        

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
		'Egreso' => array(
			'className' => 'Egreso',
			'foreignKey' => 'tipo_factura_id',
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