<?php
class Mozo extends AppModel {

	var $name = 'Mozo';

        var $actsAs = array('SoftDeletable', 'Containable');
        
        var $order = array('Mozo.activo DESC', 'Mozo.numero');
        
	var $validate = array(
		'user_id' => array(
                    'isUnique' => array(
                        'rule' => 'isUnique',
                        'message'=>'El usuario seleccionado ya tiene un numero de mozo asignado'
                     ),
                   // 'numero' => array('numeric')
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
        
        /**
         * 
         * @return stringFind 'list' de los mozos con el numero + nombre completo
         */
        function listActivos() {
            $mozosAll = $this->find('all', array(
                'fields'=>array(
                    'Mozo.id',
                    'Mozo.numero',
                    'Mozo.nombre',
                    'Mozo.apellido'),
                'recursive' => -1,
                'conditions' => array(
                    'Mozo.activo' => 1
                )
            ));

            $mozos = array();
            foreach ($mozosAll as $mz) {
                $mozos[$mz['Mozo']['id']] = "(".$mz['Mozo']['numero'] . ") " .$mz['Mozo']['nombre']. " ". $mz['Mozo']['apellido'];
            }
            return $mozos;
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
        
        
        
        
        public function beforeSave($options = array()) {
                if (!empty($this->data[$this->name]['image_url']['name'])) {
                    
	            $path = IMAGES;
				$newFile = $this->data[$this->name]['image_url'];
				
	            $name = Inflector::slug(strstr($newFile['name'], '.', true));
	            $ext = substr(strrchr($newFile['name'], "."), 1);
	            $nameFile = $name . ".$ext";
	
	            if (file_exists($path . $nameFile)) {
	                $i = 1;
	                $nameFile = $name . "_$i.$ext";
	                while (file_exists($path . $nameFile)) {
	                    $i++;
	                    $nameFile = $name . "_$i.$ext";
	                }
	            }
				
	            $this->data[$this->name]['image_url'] = $nameFile;
	            move_uploaded_file($newFile['tmp_name'], $path . $nameFile);
				
                    generate_image_thumbnail($path . $nameFile, IMAGES_THUMB . DS . $nameFile);
	        }
                return true;
            }

}
?>