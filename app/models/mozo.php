<?php
class Mozo extends AppModel {

	var $name = 'Mozo';

        var $actsAs = array('SoftDeletable', 'Containable');
        
	var $validate = array(
		'user_id' => array(
                    'isUnique' => array(
                        'rule' => 'isUnique',
                        'message'=>'El usuario seleccionado ya tiene un numero de mozo asignado'
                     ),
                   // 'numero' => array('numeric')
                    )
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Mesa' => array('className' => 'Mesa',
								'foreignKey' => 'mozo_id',
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
	 * Me devuelve todo los mozos activos
	 *
	 * @param recursive -1 por default
	 * @ return array del find(all)
	 */
	function dameActivos($recursive = 1)
	{
		$this->recursive = $recursive;
		return $this->find('all',array(
                    'contain' => array(
                        'User',
                        'Mesa' => array('conditions'=> array(
                            "Mesa.time_cobro" => "0000-00-00 00:00:00",
                         ))
                    ),
                    'conditions'=>array('Mozo.activo'=>1),
                    'order'=>'Mozo.numero ASC'));
	}
	
	
	function dameTodos($recursive = 0){
		$this->recursive = $recursive;
		return $this->find('all');
	}
	
	
	
	function getNumero($mozo_id = 0){
		if($mozo_id != 0){
			$this->id = $mozo_id;
		}
		$mozo = $this->read();
		return $mozo['Mozo']['numero'];	
	}


        /**
         * Para todos los mozos activos, me trae sus mesas abiertas
         * @param int $mozo_id id del mozo, en caso de que no le pase ninguno, me busca todos
         * @return array Mozos con sus mesas, Comandas, detalleComanda, productos y sabores
         */
        function mesasAbiertas($mozo_id = null){
            $conditions = array();
            if ( !empty($mozo_id) ){
               $conditions['Mozo.id'] =  $mozo_id;
            } else {
                // mozos activos
                $conditions['Mozo.activo'] =  1;
            }
            
            $options = array(
                'contain' => array(
                    'Mesa' => array(
                        'Cliente' => 'Descuento',
                        'Comanda' => array(
                            'DetalleComanda' => array(
                                'Producto','DetalleSabor.Sabor'),
                        ),
                        'conditions' => array(
                            "Mesa.time_cobro" => "0000-00-00 00:00:00",
                            'Mesa.deleted' => 0,
//                            "Mesa.time_cerro" => "0000-00-00 00:00:00",
                        ),
                        'order' => 'Mesa.created DESC',
                    ),
                 ),
                'conditions'=> $conditions,
            );

            return $this->find('all', $options);
        }

}
?>