<?php


App::uses('ProductAppModel', 'Product.Model');

/**
 * Categoria Model
 *
 * @property Producto $Producto
 * @property Sabor $Sabor
 */
class Categoria extends ProductAppModel
{

    public $name = 'Categoria';
    public $actsAs = array(
        'Tree',
        'Containable',
        'SoftDelete',
        'FileUpload.FileUpload' => array(
            'fields' => array(
                'name' => 'image_url', 
                'type' => 'file_type', 
                'size' => 'file_size'
                ),
        ),
        
    );
    //public $cacheQueries = true;

    public $validate = array(
        'name' => array('notempty')
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    public $hasMany = array(
        'Producto' => array(
            'className' => 'Product.Producto',
            'order' => array('Producto.order', 'Producto.name'),
            'conditions' => array('Producto.deleted' => 0)),
        'Sabor' => array(
            'className' => 'Product.Sabor',
            'order' => 'Sabor.name',
            'conditions' => array('Sabor.deleted' => 0)
            ));



    /**
   * Me devuelve un array lindo con sub arrays para cada subarbol
   * 
   * @param $categoria_id de donde yovoy a leer los hijos
   * @return unknown_type
   */
  function array_listado($categoria_id = 1){  
    $array_categoria = array(); 
                $array_final = array();
                
    $this->recursive = 1;
    $this->id = $categoria_id;
//                $this->contain(array(
//                    'Producto', 
//                    'Sabor',
//                ));
    $array_categoria = $this->read();
//                debug($array_categoria );die;
                $array_final = $array_categoria['Categoria'];
                $array_final['Producto'] = $array_categoria['Producto'];
                $array_final['Sabor'] = $array_categoria['Sabor'];
    //agarro los herederos del ROOT
    $resultado = $this->children($categoria_id,1);

    foreach ($resultado as $r):
                    $hijos = $this->array_listado($r['Categoria']['id']);
                    if (count($hijos) > 0) {
      $array_final['Hijos'][] = $hijos;
                    }
    endforeach;

                if ($array_final == false) {
                    $array_final = array();
                }
    return $array_final;
  }


  
    
    /**
     * Me devuelve un array lindo con sub arrays para cada subarbol
     * 
     * @param $parent_cat_id de donde yovoy a leer los hijos
     * @return unknown_type
     */
    // public function array_listado($cat_id = null)
    // {
    //     $conditions = array( 'Categoria.deleted' => 0 );
    //     if ( empty( $cat_id ) ) {
            
    //        $productos = $this->Producto->find('all', array(
    //            'conditions' => array(
    //                'Producto.deleted' => 0,
    //                'OR' => array (
    //                    'Producto.categoria_id' => 0,
    //                    'Producto.categoria_id IS NULL',
    //                ),
    //            ),
    //            'contain' => array(
    //                'GrupoSabor.Sabor',
    //            )
    //        ));
    //        $categoria = $productos;
    //        // categoria padre root
    //        $categoria['Categoria'] = array(
    //                 'id' => 0,
    //                 'name' => 'INICIO',
    //                );
    //     } else {
    //         $categoria = $this->find('first', array(
    //             'conditions' => array(
    //                 'Categoria.deleted' => 0,
    //                 'Categoria.id' => $cat_id
    //             ),
    //             'contain' => array(
    //                 'Producto' => array(
    //                     'GrupoSabor.Sabor',
    //                 )
    //             )
    //         ));
    //     }
                
    //    $children = $this->children($cat_id);
       
    //    $categoriasHijo = array();
    //    foreach ($children as $c) {
    //        $categoriasHijo[] = $this->array_listado($c['Categoria']['id']);
    //    }
       
    //    $catFinal = $categoria['Categoria'];
    //    if ( array_key_exists('Producto', $categoria)) {
    //       $catFinal['Producto'] = $categoria['Producto'];
    //    } else {
    //       $catFinal['Producto'] = array();
    //    }
       
    //    $catFinal['Categorias'] = $categoriasHijo;       
    //     return $catFinal;
    // }

}

?>
