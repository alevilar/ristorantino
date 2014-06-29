<?php
App::uses('ProductAppModel', 'Product.Model');

class ProductosPreciosFuturo extends ProductAppModel{
    public $belongsTo = array('Product.Producto');

    public $validate = array(
		// 'producto_id' => array(
		// 	'isUnique' => array(
		//         'on'         => 'create',
		//         'rule'       => 'isUnique',
		//         'required' => 'create',
		//     ),
	 //      )
		);
   

    public function save($data = null, $validate = true, $fieldList = array()) {
    	if ( isset($data['ProductosPreciosFuturo']['precio']) && empty( $data['ProductosPreciosFuturo']['precio'] ) ) {    	

    		// si esta setteado, pero esta vacio, entonces lo tengo que eliminar
        	if ( !$this->deleteAll( array( 'ProductosPreciosFuturo.producto_id' => $data['ProductosPreciosFuturo']['producto_id'] ))){        		
                return false;
            }
    		return true;
    	} else {   

    		if ( !empty($data['ProductosPreciosFuturo']['precio']) ) {
	        	// guardar el precio

	        	if ( !empty($data['Producto']['id']) ) {
	        		$data['ProductosPreciosFuturo']['producto_id'] = $data['Producto']['id'];	
	        	}

	            $pFut = $this->find('first', array(
	                'recursive' => -1,
	                'conditions'=> array(
	                    'ProductosPreciosFuturo.producto_id' => $data['ProductosPreciosFuturo']['producto_id']
	                )));
	            if ( !empty($pFut)) {
	            	// si existia actualizo los valores
	            	$this->id = $pFut['ProductosPreciosFuturo']['id'];
	                $precio = $data['ProductosPreciosFuturo']['precio'];
	                $data['ProductosPreciosFuturo']['id'] = $pFut['ProductosPreciosFuturo']['id'];
	                $data['ProductosPreciosFuturo']['precio'] = $precio;
	            }            
	        }

    		return parent::save($data, $validate, $fieldList); 		
    	}
    }


}
?>
