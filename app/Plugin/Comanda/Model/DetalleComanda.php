<?php
App::uses('ComandaAppModel', 'Comanda.Model');


class DetalleComanda extends ComandaAppModel {

	public $name = 'DetalleComanda';
	public $validate = array(
		'producto_id' => array('numeric'),
		'cant' => array('numeric'),
		'mesa_id' => array('numeric')
	);

	
	public $actsAs = array(
        'Search.Searchable',
        'Containable',
        );
	
	
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	public $belongsTo = array(
			'Producto' => array('className' => 'Product.Producto',
								'foreignKey' => 'producto_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Comanda' => array('className' => 'Comanda.Comanda',
								'foreignKey' => 'comanda_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''			
			)
	);
	
	public $hasMany = array(
			'DetalleSabor' => array(
								'className' => 'Comanda.DetalleSabor',
								'foreignKey' => 'detalle_comanda_id',
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



	public $filterArgs = array(
        'producto_id' => array(
            'type' => 'value',
            ),
        'categoria_id' => array(
            'type' => 'value',
            'field' => 'Producto.categoria_id'
            ),        
        'desde' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created >='
            ),
        'hasta' => array(
            'type' => 'value',
            'field' => 'DetalleComanda.created <='
            ),
        );

       
	
	
	public function guardar($data){		
		$this->save($data);
		unset($this->id);
		return $this;
	}


	public function afterSave ($created, $options = array() ) {
		$dMesa = $this->find('first', array(
                    'contain' => array('Comanda(mesa_id)'),
                    'conditions' => array('DetalleComanda.id' => $this->data['DetalleComanda']['id'])
                ));
        $this->Comanda->Mesa->id = $dMesa['Comanda']['mesa_id'];
        $this->Comanda->Mesa->saveField('modified', date('Y-m-d H:i:s'), false);
        return true;
	}



	public function saveComanda ( $fullData ) {
		$imprimir = $fullData['Comanda']['imprimir'] ? true : false;
		
		// este array contine la prioridad y la mesa_id ---> todos datos de Modelo Comanda
		$comanda = $fullData['Comanda'];

		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();		
		foreach( $fullData['DetalleComanda'] as $dc ) {

			if ( array_key_exists('cant_eliminada', $dc)) {
				$dc['cant'] = $dc['cant'] - $dc['cant_eliminada'];	
				$dc['cant_eliminada'] = 0;
			}

			if ( !array_key_exists('comandera_id', $dc)) {
				$this->Producto->id = $dc['producto_id'];
				$dc['comandera_id'] = $this->Producto->field('comandera_id');
			}


			$v_comanderas[ $dc['comandera_id'] ]['DetalleComanda'][] = $dc;
		}
		$comandas = array();
		foreach ( $v_comanderas as $dcDc) {
			$comandas[] = array(
				'Comanda' => $comanda,
				'DetalleComanda' => $dcDc['DetalleComanda']
				);
		}

		if ( !$this->Comanda->saveAll($comandas, array('deep' => true)) ) {
			return false;
		}
		return true;
	}

}
?>