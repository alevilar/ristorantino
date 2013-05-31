<?php
class Mozo extends AppModel {

	public $name = 'Mozo';
        
        public $actsAs = array('Containable');

	public $validate = array(
            'numero' => 'notempty',
            'nombre' => 'notempty',
            'apellido' => 'notempty',
	);
        
        public $virtualFields = array(
            'numero_y_nombre' => "CONCAT(Mozo.numero,' (', Mozo.nombre, ' ', Mozo.apellido, ')')",
        );
		
	

	public $hasMany = array(
			'Mesa'
	);
        
        public $order = array('Mozo.numero');
	
	
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
//                    'contain' => array(
//                        'Mesa' => array('conditions'=> array(
//                            "Mesa.time_cobro" => "0000-00-00 00:00:00",
//                         )
//                            )
//                    ),
                    'recursive' => -1,
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
        function mesasAbiertas($mozo_id = null, $lastAccess = null){
            $conditions = array();
            
            // si vino el mozo por parametro, es porque solo quiero las mesas de ese mozo
            if ( !empty($mozo_id) ){
               $conditions['Mozo.id'] =  $mozo_id;
            } else {
                // todos los mozos activos
                $conditions['Mozo.activo'] =  1;
            }
            
            // condiciones para traer mesas abiertas y pendientes de cobro
            $conditionsMesa = array(
                "Mesa.estado_id <" => MESA_COBRADA,
                'Mesa.deleted' => 0,        
            );
            
            // si vino el parametro lastAccess, traer solo las mesas actualizadas luego del ultimo pedido
            if ( !empty($lastAccess) ) {
                $conditionsMesa['Mesa.modified >='] = $lastAccess;
            }
            
            $optionsCreated = array(
                'contain' => array(
                    'Mesa' => $this->Mesa->defaultContain,
                 ),
                'conditions'=> $conditions,
            );
			$mesasABM = $this->find('all', $optionsCreated);
            return $mesasABM;
        }

}
?>