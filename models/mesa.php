<?php
class Mesa extends AppModel {

	var $name = 'Mesa';

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
								'dependent' => false,
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
	
	
}
?>