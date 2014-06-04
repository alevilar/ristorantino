<?php

App::uses('MesaAppModel', 'Mesa.Model');

class Mozo extends MesaAppModel {

	var $name = 'Mozo';

        var $actsAs = array(
            'SoftDelete', 
            'Containable'
            );
        
        public $imageUploadFieldName = 'image_url_upload';
        
        var $order = array(
            'Mozo.activo DESC', 
            'Mozo.numero'
        );
        
        public $virtualFields = array(
          'numero_y_nombre' => "CONCAT(Mozo.numero,' (', Mozo.nombre, ' ', Mozo.apellido, ')')",
        );
        
	var $validate = array(
            'numero' => 'notempty',
            'nombre' => 'notempty',
            'apellido' => 'notempty',
            'image_url' => array(
                'uploadError' => array( 
		        'rule'    => 'uploadError',
		        'message' => 'La foto no pudo ser subida.',
		        'required' => false,
		        'allowEmpty' => true
                ),
            ),
	);

        

	var $hasMany = array(
			'Mesa' => array('className' => 'Mesa.Mesa',
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
                    'recursive' => -1,
                    'conditions'=>array('Mozo.activo'=>1),
                    'order'=>'Mozo.numero ASC'));
	}
        
        /**
         * 
         * @return stringFind 'list' de los mozos con el numero + nombre completo
         */
        // function listActivos() {
        //     $mozosAll = $this->find('list', array(
        //         'fields'=>array(
        //             'Mozo.id',
        //             'Mozo.numero_y_nombre',
        //         ),
        //         'conditions' => array(
        //             'Mozo.activo' => 1
        //         )
        //     ));

        //     $mozos = array();
        //     foreach ($mozosAll as $mz) {
        //         $mozos[$mz['Mozo']['id']] = "(".$mz['Mozo']['numero'] . ") " .$mz['Mozo']['nombre']. " ". $mz['Mozo']['apellido'];
        //     }
        //     return $mozos;
        // }
	
	
	
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
        public function mesasAbiertas($mozo_id = null, $lastAccess = null){
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
        
        
        
        public function listFullName () {
            return $this->find('list', array(
                'fields'=>array(
                    'Mozo.id',
                    'numero_y_nombre',
                    ),
                'conditions' => array(
                    'Mozo.activo' => 1
                )
                ));
        }
        

}
?>