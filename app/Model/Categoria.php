<?php

$GLOBALS['papa'] = 0;

App::uses('AppModel', 'Model');

/**
 * Categoria Model
 *
 * @property Producto $Producto
 * @property Sabor $Sabor
 */
class Categoria extends AppModel
{

    var $name = 'Categoria';
    var $actsAs = array(
        'SoftDelete',
        'Tree',
        'Containable',
        'FileUpload.FileUpload' => array(
            'fields' => array('name' => 'image_url', 'type' => 'file_type', 'size' => 'file_size'),
        ),
    );
    //var $cacheQueries = true;

    var $validate = array(
        'name' => array('notempty')
    );
    //The Associations below have been created with all possible keys, those that are not needed can be removed
    var $hasMany = array(
        'Producto' => array(
            'order' => array('Producto.order', 'Producto.name'),
            'conditions' => array('Producto.deleted' => 0)),
        'Sabor' => array(
            'order' => 'Sabor.name',
            'conditions' => array('Sabor.deleted' => 0)
            ));

    
    /**
     * Me devuelve un array lindo con sub arrays para cada subarbol
     * 
     * @param $parent_cat_id de donde yovoy a leer los hijos
     * @return unknown_type
     */
    public function array_listado($cat_id = null)
    {
        $conditions = array( 'Categoria.deleted' => 0 );
        if ( empty( $cat_id ) ) {
           $categoria = array(
               'Categoria' => array(
                    'id' => 0,
                    'name' => 'INICIO',
                   )
           );
           $productos = $this->Producto->find('all', array(
               'conditions' => array(
                   'Producto.deleted' => 0,
                   'OR' => array (
                       'Producto.categoria_id' => 0,
                       'Producto.categoria_id IS NULL',
                   ),
               )
           ));
           $categoria['Producto'] = $productos['Producto'];
        } else {
            $categoria = $this->find('first', array(
                'conditions' => array(
                    'Categoria.deleted' => 0,
                    'Categoria.id' => $cat_id
                ),
                'contain' => array(
                    'Producto'
                )
            ));
        }
                
       $children = $this->children($cat_id, true);
       
       $categoriasHijo = array();
       foreach ($children as $c) {
           $categoriasHijo[] = $this->array_listado($c['Categoria']['id']);
       }
       
       $catFinal = $categoria['Categoria'];
       $catFinal['Producto'] = $categoria['Producto'];
       $catFinal['Categorias'] = $categoriasHijo;       
        return $catFinal;
    }

}

?>
