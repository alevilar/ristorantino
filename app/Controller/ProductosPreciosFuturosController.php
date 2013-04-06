<?php

class ProductosPreciosFuturosController extends AppController
{

    private $paginate = array();
        
    public $Producto;

    function beforeFilter()
    {
        parent::beforeFilter();
    }

    function index()
    {
        $this->request->params['PaginateConditions'] = array();
        if (!empty($this->request->data)) {
            $condiciones = array();
            $pagCondiciones = array();
            foreach ($this->request->data as $modelo => $campos) {
                foreach ($campos as $key => $val) {

                    if (!is_array($val)) {
                        $condiciones[$modelo . "." . $key . " LIKE"] = '%' . $val . '%';
                        $pagCondiciones[$modelo . "." . $key] = $val;
                    }
                }
            }
            $this->paginate[$this->modelClass] = array(
                'conditions' => $condiciones,
            );
        }


        if (!empty($this->passedArgs) && empty($this->request->data)) {
            $condiciones = array();
            $pagCondiciones = array();
            foreach ($this->passedArgs as $campo => $valor) {
                if ($campo == 'page' || $campo == 'sort' || $campo == 'direction') {
                    continue;
                }
                $condiciones["$campo LIKE"] = '%' . $valor . '%';
                $pagCondiciones[$campo] = $valor;
                $this->request->data[$campo] = $valor;
            }
            $this->paginate[$this->modelClass] = array(
                'conditions' => $condiciones
            );
        }

        $this->paginate['ProductosPreciosFuturo']['contain'] = array('Producto.Categoria');
        $prods = $this->paginate('ProductosPreciosFuturo');



        $this->Producto->recursive = 0;
        $this->set('productos', $prods);
    }

}
