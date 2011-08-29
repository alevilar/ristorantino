<?php
class DetalleComandasController extends AppController {

	var $name = 'DetalleComandas';
	var $helpers = array('Html', 'Form');
	var $components = array( 'Printer');

	function index() {
		$this->DetalleComanda->recursive = 0;
		$this->set('comandas', $this->paginate());
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
		Configure::write('debug',0);		
                
		$imprimir = $this->data['Comanda']['imprimir'];
		unset($this->data['Comanda']['imprimir']);		
		
		// este array contine la prioridad y la mesa_id ---> todos datos de Modelo Comanda
		$comanda = $this->data['Comanda'];
		unset($this->data['Comanda']);		
		
		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();
		foreach($this->data['DetalleComanda'] as $find_data):
			$v_comanderas[$find_data['comandera_id']] = $find_data['comandera_id'];
		endforeach;
		
		// por cada comandera involucrada creo una comanda
		$v_comandera_y_comanda = array();
		while (list($key, $value) = each($v_comanderas)):
			// Creo una comanda
			if($this->DetalleComanda->Comanda->save($comanda)){
					$ok = true;
					$v_comandera_y_comanda[$key] = $this->DetalleComanda->Comanda->getLastInsertID();
			}
			else {
				debug("No se pudo crear una nueva Comanda");
				return -1;
			}
			
		endwhile;
		
		// por cada Comanda que hice (o sea por cada comandera) genero elDetalleComanda
		while(list($comandera_id, $comanda_id) = each($v_comandera_y_comanda)){
                    
			foreach($this->data['DetalleComanda'] as $data):
                        debug($data);
				$data['comanda_id'] = $comanda_id;
				if ($data['comandera_id'] == $comandera_id){
                                    $dataToSave['DetalleComanda'] = $data;
					if ($this->DetalleComanda->save($dataToSave)){
						$ok = true;
                                                if (!empty($data['DetalleSabor'])){
                                                    $detalleSabor = $data['DetalleSabor'];
                                                    foreach ($detalleSabor as $ds){
                                                        $ds['detalle_comanda_id'] = $this->DetalleComanda->getLastInsertID();
                                                        $dataToSave['DetalleSabor'] = $ds;
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

                }
                if($imprimir){
                        //imprimio la comanda usando el Componente Printer
                        $this->Printer->imprimirComanda($comanda_id);	
                }

		
		$this->set('okval', $ok);
                $this->DetalleComanda->Comanda->contain(array('DetalleComanda' => array('DetalleSabor.Sabor')));
		$this->set('comanda', $this->DetalleComanda->Comanda->read());
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->DetalleComanda->save($this->data)) {
				$this->Session->setFlash(__('The Comanda has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->DetalleComanda->read(null, $id);
		}
		$productos = $this->DetalleComanda->Producto->find('list');
		$mesas = $this->DetalleComanda->Mesa->find('list');
		$this->set(compact('productos','mesas'));
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