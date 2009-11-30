<?php
class Producto extends AppModel {

	var $name = 'Producto';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Categoria' => array('className' => 'Categoria',
								'foreignKey' => 'categoria_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Categoria.name'
			),
			'Comandera' => array('className' => 'Comandera',
								'foreignKey' => 'comandera_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Comandera.name'
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
	
	
	
	var $validate = array(
	'abrev' => array(
		'letras_correctas' => array(
                       			//'rule' => '/^[a-zA-Z0-9 -\.\/&]+$/',
                       			'rule' => '/^[a-zA-Z_0-9 \/\-]+$/mu',
                                'required' => true,
                                'allowEmpty' => false,
                                'message' => 'La impresora fiscal no soporta acentos, eñes, puntos, ni caracteres raros. Los únicos símbolos raros admitidos son "-" y "/"'
                        )
		)
	);
	
	

}
?>
