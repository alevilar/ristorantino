<?php
class DetalleComandasController extends AppController {

	var $name = 'DetalleComandas';
	var $helpers = array('Html', 'Form');
	var $components = array( 'Printer');

	function index() {
		$this->DetalleComanda->Producto->recursive = -1;
                $conditions['order'] = array('Producto.name');
                $conditions['group'] = array('Producto.id', 'Producto.name');
                $conditions['conditions']['Mesa.deleted'] = 0;
                $conditions['joins'] = array(
                    array(
                        'table' => 'detalle_comandas',
                        'alias' => 'DetalleComanda',
                        'type' => 'left',
                        'conditions' => 'Producto.id = DetalleComanda.producto_id',
                    ),
                    array(
                        'table' => 'comandas',
                        'alias' => 'Comanda',
                        'type' => 'left',
                        'conditions' => 'Comanda.id = DetalleComanda.comanda_id',
                    ),
                    array(
                        'table' => 'mesas',
                        'alias' => 'Mesa',
                        'type' => 'left',
                        'conditions' => 'Mesa.id = Comanda.mesa_id',
                    ), 
                );
                $conditions['fields'] = array('Producto.name', 'sum(DetalleComanda.cant-DetalleComanda.cant_eliminada) as "cant"');
                
                // procesar buscador
                if (!empty($this->data)) {
                    if (!empty( $this->data['Producto']['id'] )) {
                        $conditions['conditions']['Producto.id'] = $this->data['Producto']['id'];
                    }
                    if (!empty( $this->data['Producto']['categoria_id'] )) {
                        $conditions['conditions']['Producto.categoria_id'] = $this->data['Producto']['categoria_id'];
                    }
                    if (!empty($this->data['DetalleComanda']['desde'])){
                        $conditions['conditions']['DetalleComanda.created >='] = jsDate( $this->data['DetalleComanda']['desde'] );
                    }
                    
                    if (!empty($this->data['DetalleComanda']['hasta'])){
                        $conditions['conditions']['DetalleComanda.created <='] = jsDate( $this->data['DetalleComanda']['hasta'] );
                    }
                }
                
                $this->set('categorias', $this->DetalleComanda->Producto->Categoria->generatetreelist());
                $this->set('productos', $this->DetalleComanda->Producto->find('list', array('order' => 'name')));
		$this->set('comandas', $this->DetalleComanda->Producto->find('all', $conditions));
	}
	
	function prueba(){
		debug($this->DetalleComanda->find('all'));die();
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comanda.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comanda', $this->DetalleComanda->read(null, $id));
	}

	
	function sacarProductos(){
		$this->autoRender = false;
		$ok = false;
		//Configure::write('debug',1);
		if($this->DetalleComanda->saveAll($this->data)){
			$ok = true;
		}
		
		return ($ok)?'ok':'failed to save comanda';
	}
	
	function add(){
		$ok = false;
                
		$imprimir = $this->data['Comanda']['imprimir'] ? true : false;
		unset($this->data['Comanda']['imprimir']);		
		
		// este array contine la prioridad y la mesa_id ---> todos datos de Modelo Comanda
		$comanda = $this->data['Comanda'];
		unset($this->data['Comanda']);		
		
		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();
		foreach($this->data['DetalleComanda'] as &$find_data):
                        $find_data['cant'] = $find_data['cant'] - $find_data['cant_eliminada'];
                        $find_data['cant_eliminada'] = 0;
			$v_comanderas[$find_data['comandera_id']] = $find_data['comandera_id'];
		endforeach;
		
		// por cada comandera involucrada creo una comanda
		$v_comandera_y_comanda = array();
		while (list($key, $value) = each($v_comanderas)):
			// Creo una comanda
                        $this->DetalleComanda->Comanda->create();
			if($this->DetalleComanda->Comanda->save( $comanda )){
					$ok = true;
					$v_comandera_y_comanda[$key] = $this->DetalleComanda->Comanda->getLastInsertID();
			}
			else {
				debug("No se pudo crear una nueva Comanda");
				return -1;
			}
			
		endwhile;
		
		// por cada Comanda que hice (o sea por cada comandera) genero elDetalleComanda
		foreach($v_comandera_y_comanda as $comandera_id => $comanda_id){
			foreach($this->data['DetalleComanda'] as $data):
				$data['comanda_id'] = $comanda_id;
				if ($data['comandera_id'] == $comandera_id){
                                    $dataToSave['DetalleComanda'] = $data;
                                        $this->DetalleComanda->create();
                            debug( $dataToSave );
					if ($this->DetalleComanda->save($dataToSave)){
						$ok = true;
                            debug( $data['DetalleSabor'] );
                                                if (!empty($data['DetalleSabor'])){                                                    
                                                    $detalleSabor = $data['DetalleSabor'];
                                                    foreach ($detalleSabor as $ds){
                                                        $ds['detalle_comanda_id'] = $this->DetalleComanda->getLastInsertID();
                                                        $dataToSave['DetalleSabor'] = $ds;
                                                        unset($dataToSave['DetalleSabor']['id']);
                                                        $this->DetalleComanda->DetalleSabor->create();
                                                        if ($this->DetalleComanda->DetalleSabor->save($dataToSave)){
                                                            $ok = 3;
                                                        } else {
                                                            $ok = -3;
                                                        }
                                                    }
                                                }
					}
					else {
						$ok = -2;
						break;
					}
				}				
			endforeach;
                        
                        if($imprimir){
                             //imprimio la comanda usando el Componente Printer
                                $this->Printer->imprimirComanda($comanda_id);	
                        }
                }
                

		$this->set('imprimir', $imprimir);
		$this->set('okval', $ok);
                $this->DetalleComanda->Comanda->contain(array('DetalleComanda' => array('DetalleSabor.Sabor')));
		$this->set('comanda', $this->DetalleComanda->Comanda->read());
	}

	function edit($id = null) {
            
            if($this->RequestHandler->isAjax()){
                $this->autoRender = false;
            }
                        
            if (!$id && empty($this->data)) {
                    $this->Session->setFlash(__('Invalid Comanda', true));
                    $this->redirect(array('action'=>'index'));
            }
            if (!empty($this->data)) {
                    if ($this->DetalleComanda->save($this->data)) {
                        if($this->RequestHandler->isAjax()){
                            $dMesa = $this->DetalleComanda->find('first', array(
                                'contain' => array('Comanda(mesa_id)'),
                                'conditions' => array('DetalleComanda.id' => $this->data['DetalleComanda']['id'])
                            ));
                            $this->DetalleComanda->Comanda->Mesa->id = $dMesa['Comanda']['mesa_id'];
                            $this->DetalleComanda->Comanda->Mesa->saveField('modified', $dMesa['DetalleComanda']['modified'], false);
                            return 1;
                        }
                        $this->Session->setFlash(__('The Comanda has been saved', true));
                            $this->redirect(array('action'=>'index'));
                    } else {
                        if($this->RequestHandler->isAjax()){
                            return "edit failed";
                        }
                        $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
                    }
            }
            
            if (empty($this->data)) {
                        $this->data = $this->DetalleComanda->read(null, $id);
            }           
             
            if ( !$this->RequestHandler->isAjax() ) {
                
                $productos = $this->DetalleComanda->Producto->find('list');
                $mesas = $this->DetalleComanda->Comanda->Mesa->find('list');
                $this->set(compact('productos','mesas'));
            } else {
                return 1;
            }
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DetalleComanda->del($id)) {
			$this->Session->setFlash(__('Comanda deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>