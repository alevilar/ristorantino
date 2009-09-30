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
			'DetalleComanda' => array('className' => 'DetalleComanda',
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
									where 
									mesa_id = $this->id
									group by producto_id
									having sum(cant)>0) as tabla_sumadora
									");
		return $total[0][0]['total'];
		
	}
	
	
	
	function listado_de_productos($id = 0)
	{
		//inicialiozo variable return
		$mesa = array();

		if($id != 0){
			$this->id = $id;
		}	

		
		$this->DetalleComanda->order = 'Producto.categoria_id';
		$this->DetalleComanda->recursive = 2;
		
		// le saco todos los modelos que no necesito paraqe haga mas rapido la consulta
		$this->DetalleComanda->Producto->unBindModel(array('hasMany' => array('DetalleComanda'), 
																 'belongsTo'=> array('Categoria')));
		$this->DetalleComanda->Mesa->unBindModel(array('belongsTo'=> array('Mozo','Cliente'), 
															 'hasMany' => array('DetalleComanda'),
															 'hasOne'=>array('Comensal','Pago')));
		$this->DetalleComanda->DetalleSabor->unBindModel(array('belongsTo' => array('DetalleComanda')));
		
		$items = $this->DetalleComanda->find('all',array('conditions'=>array('DetalleComanda.mesa_id'=>$this->id),
														'fields'=> array('DetalleComanda.mesa_id','DetalleComanda.producto_id','sum(DetalleComanda.cant) as cant', 'Producto.name', 'Producto.id', 'Mesa.numero'),
														'group'=> array('mesa_id','producto_id', 'Producto.name','Mesa.numero')
														));		
		return $items;
	}
	
	
}
?>