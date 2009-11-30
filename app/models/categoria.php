<?php
class Categoria extends AppModel {

	var $name = 'Categoria';
	var $actsAs = array('Tree');
	var $cacheQueries = true;
	
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Producto' => array('className' => 'Producto',
								'foreignKey' => 'categoria_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Sabor' => array('className' => 'Sabor',
								'foreignKey' => 'categoria_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => 'Sabor.name',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
	
	
	
	
	/**
	 * Me devuelve un array lindo con sub arrays para cada subarbol
	 * 
	 * @param $categoria_id de donde yovoy a leer los hijos
	 * @return unknown_type
	 */
	function array_listado($categoria_id = 1){	
		$array_final = array();	
		$this->recursive = 1;
		$this->id = $categoria_id;
		$array_final = $this->read();
		//agarro los herederos del ROOT
		$resultado = $this->children($categoria_id,1);
		
		foreach ($resultado as $r):				 
			$array_final['Hijos'][] = $this->array_listado($r['Categoria']['id']);
		endforeach;
		
		return $array_final;
		
	}

}
?>