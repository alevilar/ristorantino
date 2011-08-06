<?php

class ProductosPreciosFuturosController extends AppController {

    function index() {
		$this->params['PaginateConditions'] = array();
		if(!empty($this->data)){
			$condiciones = array();
			$pagCondiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
                                    
                                    if($key == 'no_tiene_precio_asignado'){ 
                                        if ($val) {
                                           debug("valor en 1 del no tiene precio asignado");
                                        }
                                        continue;
                                    }
                                    
                                    if(!is_array($val)) {
                                            $condiciones[$modelo.".".$key." LIKE"] = '%'.$val.'%';
                                            $pagCondiciones[$modelo.".".$key] = $val;
                                    }
				}
			}
			$this->paginate[$this->modelClass] = array(
				'conditions' => $condiciones,
			);
		}
		
		
		if(!empty($this->passedArgs) && empty($this->data)){ 
		 	$condiciones = array();
			$pagCondiciones = array();
			foreach($this->passedArgs as $campo=>$valor){
				if($campo == 'page' || $campo == 'sort' || $campo == 'direction'){ 
					continue;
				}
				$condiciones["$campo LIKE"] = '%'.$valor.'%';
				$pagCondiciones[$campo] = $valor;
				$this->data[$campo] = $valor;
				
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
