<?php
class Sabor extends AppModel {

	var $name = 'Sabor';
	var $validate = array(
		'name' => array('notempty'),
		'categoria_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Categoria' => array('className' => 'Categoria',
								'foreignKey' => 'categoria_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Categoria.name'
			)
	);

	var $hasMany = array(
			'DetalleSabor' => array('className' => 'DetalleSabor',
								'foreignKey' => 'sabor_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => 'name',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

}
?>