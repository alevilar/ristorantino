<?php

class ProductsController extends InventoryAppController
{    
   
    var $scaffold;
    
    
    function index(){
        if (!empty($this->data)){
            if ( !empty($this->data['Product']['name'])) {
                $this->paginate['conditions']['Product.name like'] = '%'.$this->data['Product']['name'].'%';
                $this->passedArgs['Product.name'] = $this->data['Product']['name'];
            }
            if ( !empty($this->data['Category']['name'])) {
                $this->paginate['conditions']['Category.name like'] = '%'.$this->data['Category']['name'].'%';
                $this->passedArgs['Category.name'] = $this->data['Category']['name'];
            }
        }
        
        if (!empty($this->passedArgs['Category.name'])){
            $this->data['Category']['name'] = $this->passedArgs['Category.name'];
            $this->paginate['conditions']['Category.name like'] = '%'.$this->passedArgs['Category.name'].'%';
        }
        if (!empty($this->passedArgs['Product.name'])){
            $this->data['Product']['name'] = $this->passedArgs['Product.name'];
            $this->paginate['conditions']['Product.name like']  = '%'.$this->passedArgs['Product.name'].'%';
        }
        
        $this->set('categoriesJson', json_encode($this->Product->Category->find('list')));
        $this->set('products', $this->paginate());
    }
    
    
    function update()
    {
        $this->Product->id = $this->params['form']['product_id'];
        if ($this->Product->saveField($this->params['form']['field'], $this->params['form']['value'], false)) {
            $txtShow = (!empty($this->params['form']['text'])) ? $this->params['form']['text'] : $this->params['form']['value'];
            echo $txtShow;
        } else {
            echo "error al guardar";
        }
        exit;
    }
    
}