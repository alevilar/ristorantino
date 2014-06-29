<?php

App::uses('ProductAppModel', 'Product.Model');

class Producto extends ProductAppModel {

	public $name = 'Producto';
    public $order = 'Producto.name';
    
    public $actsAs = array(
        'SoftDelete', 
        'Search.Searchable',
        'Containable',
        );



	//The Associations below have been created with all possible keys, those that are not needed can be removed
    public $belongsTo = array(
     'Categoria' => array(
        'className' => 'Product.Categoria',
        'foreignKey' => 'categoria_id',
        'conditions' => '',
        'fields' => '',
        'order' => 'Categoria.name'
        ),
     'Comandera' => array(
        'className' => 'Comanda.Comandera',
        'foreignKey' => 'comandera_id',
        'conditions' => '',
        'fields' => '',
        'order' => 'Comandera.name'
        )
     );

    public $hasOne = array('Product.ProductosPreciosFuturo');
    

    public $hasMany = array(
        'Product.HistoricoPrecio',
        'DetalleComanda' => array(
            'className' => 'Comanda.DetalleComanda',
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

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array('Product.Tag','Product.GrupoSabor');



    public $filterArgs = array(
        'name' => array(
            'type' => 'like',
            ),
        'precio_futuro' => array(
            'type' => 'value',
            'field' => 'ProductosPreciosFuturo.precio'
            ),
        'categoria_name' => array(
            'type' => 'value',
            'field' => 'Categoria.name'
            ),
        'abrev' => array(
            'type' => 'like',
            ),
        'comandera_id' => array(
            'type' => 'value',
            ),
        'categoria_id' => array(
            'type' => 'value',
            ),  
        'deleted' => array(
            'type' => 'value',
            ),        
        'created_from' => array(
            'type' => 'value',
            'field' => 'Producto.created >='
            ),
        'created_to' => array(
            'type' => 'value',
            'field' => 'Producto.created <='
            ),        
        );
    
    
    
//	public $validate = array(
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


    // function buscarPorNombre($texto){
    //     return $this->find('all',array('conditions'=>array('Producto.name REGEXP'=>"$texto")));
    // }



    public function save($data = null, $validate = true, $fieldList = array())
    {            
        // cargo el precio futuro si es que lo tiene
        $pf = $this->__getPrecioFuturoData( $data );
        
        // cargo con el precio historico si es que lo tiene
        $hp = $this->__getPrecioHistoricoData( $data );
        // if ( $hp ) {
        //     $data['HistoricoPrecio'] = $hp['HistoricoPrecio'];
        // }
       
        if ( !parent::save($data, $validate, $fieldList) ) {
            return false;
        }

        // finalmente guardo el precio historico
        if ( $hp && !$this->HistoricoPrecio->save($hp) ) {
            $this->validationErrors = $this->HistoricoPrecio->validationErrors;            
            return false;
        }
        
        if ( $pf && !$this->ProductosPreciosFuturo->save($pf) ) {
            $this->validationErrors = $this->ProductosPreciosFuturo->validationErrors;
            return false;
        }

        return true;
    }


    private function __getPrecioFuturoData ($data) {
        $precioFutData = null;

        if ( isset($data['ProductosPreciosFuturo'])){
            $precioFutData['ProductosPreciosFuturo'] = $data['ProductosPreciosFuturo'];    
        }
        if ( !empty($data['ProductosPreciosFuturo']['precio']) ) {

            $data['ProductosPreciosFuturo']['producto_id'] = $data['Producto']['id'];

            $precioFutData = $this->ProductosPreciosFuturo->find('first', array(
                'recursive' => -1,
                'conditions'=> array(
                    'ProductosPreciosFuturo.producto_id' => $data['Producto']['id']
                )));
            if ( !empty($precioFutData) ) {
                $precio = $data['ProductosPreciosFuturo']['precio'];
                $precioFutData['ProductosPreciosFuturo'] = $precioFutData['ProductosPreciosFuturo'];
                $precioFutData['ProductosPreciosFuturo']['precio'] = $precio;
            } else {
                $precioFutData['ProductosPreciosFuturo'] = $data['ProductosPreciosFuturo'];
            }
        }        
        return $precioFutData;
    }


    private function __getPrecioHistoricoData ($data = null ) {
        $hpData = null;

        if ( !empty($data['Producto']['id']) && !empty($data['Producto']['precio']) ) {            
            $precioViejo = $this->field( 'precio', array( 'Producto.id'=> $data['Producto']['id'] ) );
            if ( !empty($precioViejo) && ( $precioViejo != $data['Producto']['precio'])) {

                $hpData = array(
                    'HistoricoPrecio' => array(
                        'precio' => $precioViejo ,
                        'producto_id' => $data['Producto']['id'],
                        )
                );
            }
        }
        return $hpData;
    }


}
?>
