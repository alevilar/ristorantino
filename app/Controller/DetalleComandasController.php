<?php
class DetalleComandasController extends AppController {

	var $name = 'DetalleComandas';
	

	function index() {
		$this->DetalleComanda->recursive = -1;
                $conditions['order'] = array('Producto.name');

                $conditions['group'] = array('Producto.id', 'Producto.name');
                $conditions['joins'] = array(
                            array(
                                'table' => 'productos',
                                'alias' => 'Producto',
                                'type' => 'INNER',
                                'conditions' => array(
                                    'Producto.id = DetalleComanda.producto_id',
                                )
                            ),
                            array('table' => 'productos_tags',
                                'alias' => 'ProductoTag',
                                'type' => 'LEFT',
                                'conditions' => array(
                                    'Producto.id = ProductoTag.producto_id',
                                )
                            )
                        );


                $conditions['fields'] = array(
                                            'Producto.name', 
                                            'Producto.deleted',
                                            'sum(DetalleComanda.cant-DetalleComanda.cant_eliminada) as "cant"'
                    );
                
                // procesar buscador
                if (!empty($this->request->data)) {
                    if (!empty( $this->request->data['Producto']['id'] )) {
                        $conditions['conditions']['Producto.id'] = $this->request->data['Producto']['id'];
                    }
                    if (!empty( $this->request->data['Producto']['categoria_id'] )) {
                        $conditions['conditions']['Producto.categoria_id'] = $this->request->data['Producto']['categoria_id'];
                    }
                    
                    if (!empty( $this->request->data['ProductoTag']['tag_id'] )) {
                        $conditions['conditions']['ProductoTag.tag_id'] = $this->request->data['ProductoTag']['tag_id'];
                    }
                    if (!empty($this->request->data['DetalleComanda']['desde'])){
                        $conditions['conditions']['DetalleComanda.created >='] = jsDate( $this->request->data['DetalleComanda']['desde'] );
                    }
                    
                    if (!empty($this->request->data['DetalleComanda']['hasta'])){
                        $conditions['conditions']['DetalleComanda.created <='] = jsDate( $this->request->data['DetalleComanda']['hasta'] );
                    }
                }
                $this->set('productos', $this->DetalleComanda->Producto->find('list', array('order' => 'name')));
		$this->set('comandas', $this->DetalleComanda->find('all', $conditions));
                $this->set('tags', $this->DetalleComanda->Producto->Tag->find('list'));
                $this->set('categorias', $this->DetalleComanda->Producto->Categoria->find('list'));
	}
	
        

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comanda.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comanda', $this->DetalleComanda->read(null, $id));
	}

	
	function sacarProductos(){
		$this->autoRender = false;
		$ok = false;
		//Configure::write('debug',1);
		if($this->DetalleComanda->saveAll($this->request->data)){
			$ok = true;
		}
		
		return ($ok)?'ok':'failed to save comanda';
	}
	
	

	function edit($id = null) {
            
            if($this->RequestHandler->isAjax()){
                $this->autoRender = false;
            }
                        
            if (!$id && empty($this->request->data)) {
                    $this->Session->setFlash(__('Invalid Comanda'));
                    $this->redirect(array('action'=>'index'));
            }
            if (!empty($this->request->data)) {
                    if ($this->DetalleComanda->save($this->request->data)) {
                        if($this->RequestHandler->isAjax()){
                            $dMesa = $this->DetalleComanda->find('first', array(
                                'contain' => array('Comanda(mesa_id)'),
                                'conditions' => array('DetalleComanda.id' => $this->request->data['DetalleComanda']['id'])
                            ));
                            $this->DetalleComanda->Comanda->Mesa->id = $dMesa['Comanda']['mesa_id'];
                            $this->DetalleComanda->Comanda->Mesa->saveField('modified', $dMesa['DetalleComanda']['modified'], false);
                            return 1;
                        }
                        $this->Session->setFlash(__('The Comanda has been saved'));
                            $this->redirect(array('action'=>'index'));
                    } else {
                        if($this->RequestHandler->isAjax()){
                            return "edit failed";
                        }
                        $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.'));
                    }
            }
            
            if (empty($this->request->data)) {
                        $this->request->data = $this->DetalleComanda->read(null, $id);
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
			$this->Session->setFlash(__('Invalid id for Comanda'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->DetalleComanda->delete($id)) {
			$this->Session->setFlash(__('Comanda deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>