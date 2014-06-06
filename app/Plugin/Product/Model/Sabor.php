<?php

App::uses('ProductAppModel', 'Product.Model');

class Sabor extends ProductAppModel {

	public $name = 'Sabor';


    public $actsAs = array(
        'SoftDelete', 
        'Search.Searchable',
        'Containable',
        );


	public $validate = array(
		'name' => array('notempty'),
		'categoria_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Categoria' => array('className' => 'Product.Categoria',
								'foreignKey' => 'categoria_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Categoria.name'
			)
	);

	public $hasMany = array(
			'DetalleSabor' => array('className' => 'Product.DetalleSabor',
								'foreignKey' => 'sabor_id',
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



	public $filterArgs = array(
        'name' => array(
            'type' => 'like',
            ),
        'precio' => array(
            'type' => 'value',
            ),
        'categoria_name' => array(
            'type' => 'like',
            'field' => 'Categoria.name'
            ),
        'categoria_id' => array(
            'type' => 'value',
            ),  
        'created_from' => array(
            'type' => 'value',
            'field' => 'Producto.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Producto.created <='
            ),        
        );

}
?>