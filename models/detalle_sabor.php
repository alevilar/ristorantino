<?php
class DetalleSabor extends AppModel {

	var $name = 'DetalleSabor';
	var $validate = array(
		'detalle_comanda_id' => array('numeric'),
		'sabor_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'DetalleComanda' => array('className' => 'DetalleComanda',
								'foreignKey' => 'detalle_comanda_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Sabor' => array('className' => 'Sabor',
								'foreignKey' => 'sabor_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>