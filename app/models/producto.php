<?php
class Producto extends AppModel {

	var $name = 'Producto';
        var $order = 'Producto.name';
        
        var $actsAs = array('SoftDeletable');


	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Categoria' => array('className' => 'Categoria',
								'foreignKey' => 'categoria_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Categoria.name'
			),
			'Comandera' => array('className' => 'Comandera',
								'foreignKey' => 'comandera_id',
								'conditions' => '',
								'fields' => '',
								'order' => 'Comandera.name'
			)
	);

        var $hasOne = array('ProductosPreciosFuturo');
        

	var $hasMany = array(
            'HistoricoPrecio',
			'DetalleComanda' => array('className' => 'DetalleComanda',
								'foreignKey' => 'producto_id',
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
	
	
	
//	var $validate = array(
//	'abrev' => array(
//		'letras_correctas' => array(
//                                //'rule' => '/^[a-zA-Z0-9 -\.\/&]+$/',
//                                'rule' => '/^[a-zA-Z_0-9 \/\-]+$/mu',
//                                'required' => true,
//                                'allowEmpty' => false,
//                                'message' => 'La impresora fiscal no soporta acentos, eñes, puntos, ni caracteres raros. Los únicos símbolos raros admitidos son "-" y "/"'
//                        )
//		),
//	);


        function buscarPorNombre($texto){
            return $this->find('all',array('conditions'=>array('Producto.name REGEXP'=>"$texto")));
        }


        function   beforeSave($options = array()) 
    {            
        if ( isset($options['validate']) && $options['validate'] && !empty($this->data['Producto']['id']) && !empty($this->data['Producto']['precio'])) {
            $precioViejo = $this->field('precio', array('Producto.id'=>$this->data['Producto']['id']));
            if ( $this->data['Producto']['precio'] != $precioViejo ){
                                
                $this->ProductosPreciosFuturo->create();
                if ( !$this->ProductosPreciosFuturo->save(array(
                    'ProductosPreciosFuturo' => array(
                        'precio' => $this->data['Producto']['precio'] ,
                        'producto_id' => $this->data['Producto']['id'],
                        )
                ), false)){
                    return false;
                    }                                
            } else {
                $this->data['Producto']['precio'] = $precioViejo;                
            }
        }
        
        if (!empty($precioViejo)) {
            $this->HistoricoPrecio->create();
            if ( !$this->HistoricoPrecio->save(array(
                        'HistoricoPrecio' => array(
                            'precio' => $precioViejo ,
                            'producto_id' => $this->data['Producto']['id'],
                            )
                    ), false)){
                        return false;
            }
        }
                    
                    
        return true;
       
    }
	
	

}
?>
