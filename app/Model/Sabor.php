<?php
App::uses('AppModel', 'Model');
/**
 * Sabor Model
 *
 * @property Categoria $Categoria
 * @property DetalleComanda $DetalleComanda
 */
class Sabor extends AppModel {
/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';
        
        public $actsAs = array(
            'SoftDelete', 
            'Search.Searchable'
            );
      
       public $filterArgs = array(
			'name' => array('type' => 'like'),
			'categoria' => array('type' => 'like', 'field' => 'Categoria.name'),
                        'precio' => array('type' => 'value'),
        );
      
      
/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'name' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'categoria_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'deleted' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Categoria' => array(
			'className' => 'Categoria',
			'foreignKey' => 'categoria_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
      
        
        public $hasMany = array('GrupoSabor');
}
