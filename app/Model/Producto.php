<?php
/**
 * Producto Model
 * 
 * @property Producto $Producto
 */
class Producto extends AppModel {

	public $name = 'Producto';
        public $order = 'Producto.name';
        
        public $actsAs = array(
            'SoftDeletable', 
            'Containable', 
            'Search.Searchable',
            );
        
        public $filterArgs = array(
			'name' => array('type' => 'like'),
			'abrev' => array('type' => 'like'),
			'categoria' => array('type' => 'like', 'field' => 'Categoria.name'),
                        'categoria_id' => array('type' => 'value', 'field' => 'Producto.categoria_id'),
                        'precio' => array('type' => 'value'),
                        'comandera' => array('type' => 'value', 'field' => array('Comandera.name', 'Comandera.description')),
                        'comandera_id' => array('type' => 'value', 'field' => 'Producto.comandera_id'),
			'tag' => array('type' => 'subquery', 'field' => 'Producto.id',  'method' => 'findByTags'),
		);


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
            'DetalleComanda',
	);
        
        
    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
	public $hasAndBelongsToMany = array('Tag','GrupoSabor');
	
	
	
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
            $txt = convertir_para_busqueda_avanzada($texto);
            return $this->find('all',array('conditions'=>array('Producto.name REGEXP'=>"$txt")));
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
	
    
    public function findByTags($data = array()) {
			$this->Tag->Behaviors->attach('Search.Searchable');
			$query = $this->Tag->getQuery('all', array(
				'conditions' => array(
                                    'Tag.name LIKE'  => "%{$data['tag']}%",
                                    ),
				'fields' => array('PT.producto_id'),
                                'joins' => array(
                                    array(
                                        'table' => 'productos_tags',
                                        'alias' => 'PT',
                                        'type' => 'LEFT',
                                        'conditions' => array(
                                            'PT.tag_id = Tag.id',
                                            )
                                        )  
                                ),
			));
			return $query;
    }
    
    
    function listadoCompleto(){
        $conditions = array(
            'contain' => array(
                'GrupoSabor.Sabor',
                'Categoria',
            ),
        );
        return $this->find('all',$conditions);
    }

}
?>
