<?php

class CountsController extends InventoryAppController
{

    var $scaffold;
    
    
    function listar_faltantes_para_imprimir($categoria = 0){
        $pno = $this->Count->find('list', array(
            'fields' => array( 'product_id', 'product_id'),
            'group'  => 'product_id',
        ));
        
        $condsAll = array();
        if ( count($pno) == 1 ){
            $val = array_keys($pno);
                $condsAll['Product.id <>'] = $val[0];
        } else if( count($pno) > 1) {
            $condsAll['Product.id NOT'] = $pno;
        }
        
        if ( !empty($categoria)) {
            $condsAll['Product.category_id'] = $categoria;
        }

        
        $prodsQueFaltan = $this->Count->Product->find('all', array(
            'conditions' => $condsAll,
            'order'      => array('Product.name'),
            ));
        
        $this->data['Count']['count'] = null;
        $this->set('prodsQueFaltan', $prodsQueFaltan);
        $this->set('categorias', $this->Count->Product->Category->find('list'));
    }
    
    
    function add($prodId = 0){
        
        if ( !empty($this->data) ){
            if ($this->Count->save($this->data)){
                $this->Session->setFlash('Se guardó unmnuevo inventario');
            }
        }
        
        $pno = $this->Count->find('list', array(
            'fields' => array( 'product_id', 'product_id'),
            'group'  => 'product_id',
        ));
        
        $conds = $condsAll = array();
        if ( count($pno) == 1 ){
            $val = array_keys($pno);
                $conds['Product.id <>'] = $val[0];
                $condsAll['Product.id <>'] = $val[0];
        } else if( count($pno) > 1) {
            $conds['Product.id NOT'] = $pno;
            $condsAll['Product.id NOT'] = $pno;
        }
            
        if ( !empty($prodId) ){
            $conds['Product.id'] = $prodId;
        }

        $conds = array(
            'conditions' => $conds,
        );
        $prod = $this->Count->Product->find('first', $conds);
        
        $prodsQueFaltan = $this->Count->Product->find('all', array(
            'conditions' => $condsAll,
            'order'      => array('Product.name'),
            ));
        
        $this->data['Count']['count'] = null;
        $this->set('prod', $prod);
        $this->set('prodsQueFaltan', $prodsQueFaltan);
    }
}