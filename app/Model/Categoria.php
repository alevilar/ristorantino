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
    public function array_listado($parent_cat_id = null)
    {
        $conditions = array( 'Categoria.deleted' => 0 );
        if (empty($parent_cat_id)) {
            // categorias root
            $conditions[] = 'Categoria.parent_id IS NULL';
        } else {
            $conditions['Categoria.parent_id'] = $parent_cat_id;
        }
        
        $categorias = $this->find('all', array(
                'conditions' => $conditions,
                'contain' => array(
                    'Producto',
                    'Sabor',
                )
            ));
        foreach ($categorias as &$c) {
            $c['Hijos'] = $this->array_listado($c['Categoria']['id']);
        }
        
        
        return $categorias;
    }

}

?>