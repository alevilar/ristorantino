<?php
class ProductosController extends AppController {

	var $name = 'Productos';
	var $helpers = array('Html', 'Form', 'Number');
        
        public $paginate = array(
            'limit' => 30,
            'order' => array(
                'Producto.name' => 'asc',
            )
        );

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
        
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
			$this->Producto->recursive = 1;
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
		 
		 
		$this->Producto->recursive = 0;
                $comanderas = $this->Producto->Comandera->listWithDescription();
		$categorias = $this->Producto->Categoria->generatetreelist(null, null, null, '___');
                $this->set(compact('categorias','comanderas'));
		$this->set('productos', $this->paginate());
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
            $this->rutaUrl_for_layout[] =array('name'=> 'Productos','link'=>'/productos' );
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
            $this->rutaUrl_for_layout[] =array('name'=> 'Productos','link'=>'/productos' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Producto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Producto->save($this->data)) {
//                            $this->Session->setFlash('El producto fue guardado correctamente');
                            if (!empty($this->data['ProductosPreciosFuturo']['precio'])){
                                $this->data['ProductosPreciosFuturo']['producto_id'] = $this->data['Producto']['id'];
                                //debug($this->Producto->ProductosPreciosFuturo);die;
                                if (!$this->Producto->ProductosPreciosFuturo->save($this->data['ProductosPreciosFuturo'])){
                                    $this->Session->setFlash(__('No se pudo guardar el precio futuro', true));
                                }
                                
                            // reseteo los precios futuros
                            } elseif(!empty($this->data['ProductosPreciosFuturo']['producto_id'])){
                                if (!$this->Producto->ProductosPreciosFuturo->del($this->data['ProductosPreciosFuturo']['producto_id'], false)){
                                    $this->Session->setFlash(__('No se pudo eliminar el precio futuro', true));
                                }
                            }
                            $this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}
                
                $this->data = $this->Producto->read(null, $id);
                $tags = $this->Producto->Tag->find('list');
		$comanderas = $this->Producto->Comandera->find('list',array('fields'=>array('id','description')));
		$categorias = $this->Producto->Categoria->generatetreelist(null, null, null, '___');
		$this->set(compact('categorias','comanderas','tags'));
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
        
        
        function sinpreciosfuturos(){
             $this->rutaUrl_for_layout[] =array('name'=> 'Precios Futuros','link'=>'/productos_precios_futuros' );
		$this->params['PaginateConditions'] = array();
		if(!empty($this->data)){
			$condiciones = array();
			$pagCondiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
                                                                        
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
                                                
                 $query = 'SELECT * FROM `productos` WHERE `id` NOT IN 
                                (SELECT DISTINCT `producto_id` FROM `productos_precios_futuros`) 
                                        ORDER BY `productos`.`id` ASC';
                 
                 $prod_sinpf = $this->Producto->query($query);
                 
//                 //debug($prod_sinpf);
//                 
//                 $condiciones["productos_precios NOT IN"] = '(SELECT DISTINCT `producto_id` FROM `productos_precios_futuros`)';
//                 
//                 	$this->paginate['Producto'] = array(
//				'conditions' => $condiciones
//			);
                 
                 
		$this->Producto->recursive = 0;
		$this->set('productos', $prod_sinpf);
           
            
            
        }
        
        
        
        
        function update()
        {
            Configure::write('debug',0);
            $this->Producto->id = $this->params['form']['product_id'];
            
            $pf = 'precio_futuro';
            
            if ( $this->params['form']['field'] == 'precio_futuro') {
                //buscar a ver si existe previamente
                $ppf = $this->Producto->ProductosPreciosFuturo->read(null, $this->Producto->id );
                $ppf['ProductosPreciosFuturo']['producto_id'] = $this->Producto->id;
                $ppf['ProductosPreciosFuturo']['precio'] = trim(trim($this->params['form']['value']), "$");
                
                // si existe y el precio vino vacio, borrarlo
                if ( !empty($ppf) && empty($ppf['ProductosPreciosFuturo']['precio']) && !is_numeric($ppf['ProductosPreciosFuturo']['precio'])) {
                    $proddel = $this->Producto->ProductosPreciosFuturo->delete( $ppf['ProductosPreciosFuturo']['producto_id'] );
                } else {
                    if ( $this->Producto->ProductosPreciosFuturo->save($ppf) )  {
                        $txtShow = (!empty($this->params['form']['text'])) ? $this->params['form']['text'] : $this->params['form']['value'];
                        echo $txtShow;
                    } else {
                        echo "error al guardar";
                    }
                }
            } else {
                if ($this->Producto->saveField($this->params['form']['field'], trim(trim($this->params['form']['value']),'$'), false)) {
                    $txtShow = (!empty($this->params['form']['text'])) ? $this->params['form']['text'] : $this->params['form']['value'];
                    echo $txtShow;
                } else {
                    echo "error al guardar";
                }
            }
            exit;
        }
        
        
        
      
}

?>