<?php
class ProductosController extends AppController {

	var $name = 'Productos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->params['PaginateConditions'] = array();
		
		if(!empty($this->data)){
			$condiciones = array();
			$pagCondiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
						if(!is_array($val))
							$condiciones[$modelo.".".$key." LIKE"] = '%'.$val.'%';
							$pagCondiciones[$modelo.".".$key] = $val;
				}
			}
			$this->Producto->recursive = 0;
			$this->paginate['Producto'] = array(
				'conditions' => $condiciones
			);
			
			$this->params['PaginateConditions'] = $pagCondiciones;
			$this->set('productos', $this->paginate('Producto'));
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
			$this->Producto->recursive = 0;
			$this->paginate['Producto'] = array(
				'conditions' => $condiciones
			);
			$this->params['PaginateConditions'] = $pagCondiciones;
			$this->set('productos', $this->paginate('Producto'));
		 }   
		 
		 
		/***
                 * 
                 * ES PARA BORRARRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRRR
                 * 
                 */
                 $prodsConPrecioFuturo = $this->Producto->ProductosPreciosFuturo->find('all', array(
                     'fields' => 'producto_id'
                 ));
                 if ( count($prodsConPrecioFuturo) > 1 ) {
                    $this->paginate['Producto']['conditions']['Producto.id NOT IN'] = array('874','3267');
                 } else {
                     $this->paginate['Producto']['conditions']['Producto.id <>'] = array('874');
                 }
		 /****************************
                  * 
                  * ------------------------------------------------------
                  */
                 
                 
                 
		$this->Producto->recursive = 0;
		$this->set('productos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Producto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('producto', $this->Producto->read(null, $id));
	}
	
	/**
	 * busca un producto por su nombre
	 * @param string $nombre
	 * @return array
	 */
	function buscar_por_nombre($nombre){
			$this->Producto->recursive=-1;
                        $this->set('productos',$this->Producto->buscarPorNombre($nombre));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Producto->create();
			if ($this->Producto->save($this->data)) {
				$this->Session->setFlash(__('The Producto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}
		$comanderas = $this->Producto->Comandera->find('list',array('fields'=>array('id','description')));
		$categorias = $this->Producto->Categoria->generatetreelist(null, null, null, '___');
		$this->set(compact('categorias','comanderas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Producto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Producto->save($this->data)) {
                            $this->Session->setFlash(__('The Producto has been saved', true));
                            if (!empty($this->data['ProductosPreciosFuturo']['precio'])){
                                $this->data['ProductosPreciosFuturo']['producto_id'] = $this->data['Producto']['id'];
                                //debug($this->Producto->ProductosPreciosFuturo);die;
                                if (!$this->Producto->ProductosPreciosFuturo->save($this->data['ProductosPreciosFuturo'])){
                                    $this->Session->setFlash(__('No se pudo guardar el precio futuro', true));
                                }
                            } elseif(!empty($this->data['ProductosPreciosFuturo']['producto_id'])){
                                if (!$this->Producto->ProductosPreciosFuturo->del($this->data['ProductosPreciosFuturo']['producto_id'])){
                                    $this->Session->setFlash(__('No se pudo eliminar el precio futuro', true));
                                }
                            }
                            $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Producto->read(null, $id);
		}
		$comanderas = $this->Producto->Comandera->find('list',array('fields'=>array('id','description')));
		$categorias = $this->Producto->Categoria->generatetreelist(null, null, null, '___');
		$this->set(compact('categorias','comanderas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Producto', true));
			
		}
		if ($this->Producto->del($id)) {
			$this->Session->setFlash(__('Producto deleted', true));
		}
                $this->redirect(array('action'=>'index'));
	}
	
	
	function buscarProductos(){
		
		$this->render('index');
		
	}


        function actualizarPreciosFuturos(){
            $failed = false;
            $preciosFuturos = $this->Producto->ProductosPreciosFuturo->find('all');
            foreach ($preciosFuturos as $pf){
                $productos = array();
                $productos['Producto']['precio'] = $pf['ProductosPreciosFuturo']['precio'];
                $productos['Producto']['id'] = $pf['ProductosPreciosFuturo']['producto_id'];
                if (!$this->Producto->save($productos, array('validate'=>false))){
                    $failed = true;
                }
            }
            if (!$failed){
                $this->Producto->query("
                    truncate productos_precios_futuros
                ");
                $this->Session->setFlash('Se han modificado TODOS los precios futuros de los productos');
            } else {
                $this->Session->setFlash('Fallo al aplicar los cambios');
                debug($this->Producto);
            }

            
            $this->redirect($this->referer());
        }
        
        
        
      
}

?>