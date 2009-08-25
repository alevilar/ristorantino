<?php
class Producto extends AppModel {

	var $name = 'Producto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Categoria' => array('className' => 'Categoria',
								'foreignKey' => 'categoria_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'DetalleComanda' => array('className' => 'DetalleComanda',
								'foreignKey' => 'producto_id',
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