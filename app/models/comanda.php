<?php

define('DETALLE_COMANDA_TRAER_TODO', 0);
define('DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES', 1);
define('DETALLE_COMANDA_TRAER_ENTRADAS', 2);


class Comanda extends AppModel {

	var $name = 'Comanda';
	
	var $actsAs = array('Containable');

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'DetalleComanda' => array('className' => 'DetalleComanda',
								'foreignKey' => 'comanda_id',
								'dependent' => true,
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
	
	
	var $belongsTo = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'mesa_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	
	function dame_las_comandas_abiertas(){
		$mesas_abiertas = $this->Mesa->listado_de_abiertas();
		
		foreach($mesas_abiertas as $m):
			$ids[] = $m['Mesa']['id'];
		endforeach;
		
		return $this->find('all',array('conditions'=>array('Comanda.mesa_id'=>$ids)));
	}
	
	
	
	
	
	
	
	
	
	/**
	 * @param comanda_id
	 * @param con_entrada 	0 si quiero todos los productos
	 * 						1 si quiero solo platos principales
	 * 						2 si quiero solo las entradas
	 *
	 */
	function listado_de_productos_con_sabores($id, $con_entrada = DETALLE_COMANDA_TRAER_TODOS){
		//inicialiozo variable return
		$items = array();

		if($id != 0){
			$this->id = $id;
		}

		
		$this->DetalleComanda->order = 'Producto.categoria_id';
		/*
		$this->DetalleComanda->recursive = 2;
		
		// le saco todos los modelos que no necesito paraqe haga mas rapido la consulta
		$this->DetalleComanda->Producto->unBindModel(array('hasMany' => array('DetalleComanda'), 
																 'belongsTo'=> array('Categoria')));
												 
		$this->DetalleComanda->DetalleSabor->unBindModel(array('belongsTo' => array('DetalleComanda')));
		*/
		unset($condiciones);
		$condiciones[]['Comanda.id'] = $this->id;
		
		switch($con_entrada){
			case DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES: // si quiero solo platos principales
				$condiciones[]['DetalleComanda.es_entrada'] = 0;
				break;
			case DETALLE_COMANDA_TRAER_ENTRADAS: // si quiero solo entradas
				$condiciones[]['DetalleComanda.es_entrada'] = 1;
				break;
			default: // si quiero todo = DETALLE_COMANDA_TRAER_TODoS
				break;
		}
		
		
		$items = $this->DetalleComanda->find('all',array('conditions'=>$condiciones,
														'contain'=>array(
																			'Producto'=>array('Comandera'),
																			'Comanda'=> array('Mesa'=>array('Mozo')),
																			'DetalleSabor'=>array('Sabor(name)')
			)
											));

		return $items;
	}
	
	
	/**
	 * @param comanda_id
	 * @return array() de comandera_id
	 */
	function comanderas_involucradas($id){
		$this->recursive = 2;
		$group = array('Producto.comandera_id');
		$result =  $this->DetalleComanda->find('all',array(	
                    'conditions' => array('DetalleComanda.comanda_id'=> $id),
                            'group'=>$group,
                            'fields'=>$group));
		$v_retorno = array();
		foreach($result as $r){
			$v_retorno[] = $r['Producto']['comandera_id'];
		}
		return $v_retorno;
	}
	

}
?>