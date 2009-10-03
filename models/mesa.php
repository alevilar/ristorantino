<?php
class Mesa extends AppModel {

	var $name = 'Mesa';

	
	var $validate = array(
		'numero' => array('notempty','numeric')
	);
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Mozo' => array('className' => 'Mozo',
								'foreignKey' => 'mozo_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Cliente' => array('className' => 'Cliente',
								'foreignKey' => 'cliente_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);


	
	var $hasOne = array(
			'Comensal' => array('className' => 'Comensal',
								'foreignKey' => 'mesa_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Pago' => array('className' => 'Pago',
								'foreignKey' => 'mesa_id',
								'dependent' => true,
								'conditions' => '',
								'fields' => '',
								'order' => '')
	);

	var $hasMany = array(
			'Comanda' => array('className' => 'Comanda',
								'foreignKey' => 'mesa_id',
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
	
	
	
	
	function cerrar_mesa($mesa_id = 0)
	{
		$this->id = ($mesa_id == 0)?$this->id:$mesa_id;	
				
		$result = $this->saveField('time_cerro', date( "Y-m-d H:i:s",strtotime('now')));
		$result = $this->saveField('total', $this->calcular_total());
		
		
		
	}
	
	
	

	
	/**
	 * Calcula el total de la mesa cuyo id fue seteado en $this->Mesa->id 
	 * return @total el valor
	 */
	function calcular_total(){
		$fields 	= array('sum(cant)*precio as "total"');
		$conditions = array('mesa_id'=>$this->id);
		$group 		= 'producto_id having sum(cant)>0';
		//return $this->DetalleComanda->find('first',array('fields'=>$fields, 'conditions'=> $conditions, 'group'=>$group));
		
		
		$total =  $this->query("
									select sum(total) as total from (select sum(cant)*precio as total
									from detalle_comandas 
									left join productos on (producto_id = productos.id)
									left join comandas on (comanda_id = comandas.id)
									where 
									mesa_id = $this->id
									group by producto_id
									having sum(cant)>0) as tabla_sumadora
									");
		return $total[0][0]['total'];
		
	}
	
	
	
	
	
	
	/**
	 * Me devuelve ellistado de productos de una mesa en especial
	 *
	 */
	function listado_de_productos($id = 0)
	{
		//inicialiozo variable return
		$mesa = array();

		if($id != 0){
			$this->id = $id;
		}	

		
		$this->Comanda->DetalleComanda->order = 'Producto.categoria_id';
		$this->Comanda->DetalleComanda->recursive = 2;
		
		// le saco todos los modelos que no necesito paraqe haga mas rapido la consulta
		$this->Comanda->DetalleComanda->Producto->unBindModel(array('hasMany' => array('DetalleComanda'), 
																 'belongsTo'=> array('Categoria')));
		/*
		$this->Comanda->DetalleComanda->Comanda->Mesa->unBindModel(array('belongsTo'=> array('Mozo','Cliente'), 
															 'hasMany' => array('DetalleComanda'),
															 'hasOne'=>array('Comensal','Pago')));
*/															 
		$this->Comanda->DetalleComanda->DetalleSabor->unBindModel(array('belongsTo' => array('DetalleComanda')));
		
		$items = $this->Comanda->DetalleComanda->find('all',array('conditions'=>array('Comanda.mesa_id'=>$this->id),
														'fields'=> array('Comanda.mesa_id','DetalleComanda.producto_id','sum(DetalleComanda.cant) as cant', 'Producto.name', 'Producto.id'),
														'group'=> array('Comanda.mesa_id','producto_id', 'Producto.name')
											));
			
		return $items;
	}
	
	
	
	
	function listado_de_abiertas($recursive = -1){
		$this->recursive = $recursive;
		return $this->find('all', array('conditions'=>array('created <>'=>'0000-00-00 00:00:00', 'time_cerro'=>'0000-00-00 00:00:00')));
	}
	
	
	/**
	 * nos dice si el numero de mesa existe o no
	 * 
	 * @param integer numero demesa
	 * @return boolean
	 */
	function numero_de_mesa_existente($numero_mesa){
		$this->recursive = -1;
		$result = $this->find('all',array(
									'conditions'=>array('created <>'=>'0000-00-00 00:00:00', 'time_cerro'=>'0000-00-00 00:00:00', 'numero'=>$numero_mesa)
		));
		
		return (count($result)>0)?true:false;
		
	}
}
?>