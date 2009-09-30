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

}
?>