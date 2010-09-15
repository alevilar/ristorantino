<?php


class Categoria extends AppModel {
	var $name = 'Categoria';
	var $actsAs = array('SoftDeletable', 'Tree');
	//var $cacheQueries = true;
	
	var $validate = array(
		'name' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array('Producto' => array(
                                'order'=>'Producto.name',
                                'conditions' => array('Producto.deleted <>'=>1)),
                             'Sabor' => array(
                                 'order'=>'Sabor.name',
                                'conditions' => array('Sabor.deleted <>'=>1)
                             ));
	
	
	
	
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
                    $hijos = $this->array_listado($r['Categoria']['id']);
                    if (count($hijos) > 0) {
			$array_final['Hijos'][] = $hijos;
                    }
		endforeach;

                if ($array_final == false) {
                    $array_final = array();
                }
		return $array_final;
	}

}
?>