<?php
class Comanda extends AppModel {

	var $name = 'Comanda';

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
	 *
	 */
	function listado_de_productos_con_sabores($id){
		//inicialiozo variable return
		$items = array();

		if($id != 0){
			$this->id = $id;
		}	

		
		$this->DetalleComanda->order = 'Producto.categoria_id';
		$this->DetalleComanda->recursive = 2;
		
		// le saco todos los modelos que no necesito paraqe haga mas rapido la consulta
		$this->DetalleComanda->Producto->unBindModel(array('hasMany' => array('DetalleComanda'), 
																 'belongsTo'=> array('Categoria')));
		/*
		$this->Comanda->DetalleComanda->Comanda->Mesa->unBindModel(array('belongsTo'=> array('Mozo','Cliente'), 
															 'hasMany' => array('DetalleComanda'),
															 'hasOne'=>array('Comensal','Pago')));
*/															 
		$this->DetalleComanda->DetalleSabor->unBindModel(array('belongsTo' => array('DetalleComanda')));
		
		$items = $this->DetalleComanda->find('all',array('conditions'=>array('Comanda.id'=>$this->id)
											));
			
		return $items;
	}

}
?>