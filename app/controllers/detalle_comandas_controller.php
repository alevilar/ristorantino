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
		
		
		$this->DetalleComanda->Comanda->create();
			if($this->DetalleComanda->Comanda->saveAll($this->data)){
				$ok = true;
			}
		//unset($this->data['Comanda']);
		/*
		$cont = 0;
		foreach ($this->data['DetalleComanda'] as $dv):
			$detacomanda[$cont] = $dv;
			$detacomanda[$cont]['comanda_id'] = $this->DetalleComanda->Comanda->id;
			$cont++;
		endforeach;
		
		if($this->DetalleComanda->saveAll($detacomanda)){
			$ok = true;
		}
		else $ok = false;
		*/
		
		return ($ok)?'ok':'failed to save comanda';
	}
	
	function add(){
		$this->autoRender = false;
		$ok = false;
		//Configure::write('debug',1);
		
		
		$imprimir = $this->data['imprimir'];
		unset($this->data['imprimir']);
		
		
		// este array contine la prioridad y la mesa_id ---> todos datos de Modelo Comanda
		$comanda = $this->data['Comanda'];
		unset($this->data['Comanda']);
		
		
		//cuento la cantidad de comanderas involucradas en este pedido para genrar la cantidad de comandas correspondientes
		$v_comanderas = array();
		foreach($this->data as $find_data):
			$v_comanderas[$find_data['DetalleComanda']['comandera_id']] = $find_data['DetalleComanda']['comandera_id'];
		endforeach;
		
		// por cada comandera involucrada creo una comanda
		$v_comandera_y_comanda = array();
		while (list($key, $value) = each($v_comanderas)):
			// Creo una comanda
			$this->DetalleComanda->Comanda->create();
			if($this->DetalleComanda->Comanda->save($comanda)){
					$ok = true;
					$v_comandera_y_comanda[$key] = $this->DetalleComanda->Comanda->id;
			}
			else {
				debug("No se pudo crear una nueva Comanda");
				return false;
			}
			
		endwhile;
		
		// por cada Comanda que hice (o sea por cada comandera) genero elDetalleComanda
		while(list($comandera_id, $comanda_id) = each($v_comandera_y_comanda)):
			foreach($this->data as $data):
				$data['DetalleComanda']['comanda_id'] = $comanda_id;
				if ($data['DetalleComanda']['comandera_id'] == $comandera_id){
					if ($this->DetalleComanda->saveAll($data)){
						$ok = true;
					}
					else {
						$ok = false;
						break;
					}
				}				
			endforeach;
			if($imprimir){
				//imprimio la comanda usando el Componente Printer
				$this->Printer->imprimirComanda($comanda_id);	
			}
		endwhile;
		
		
					
		return ($ok)?'ok':'failed to save comanda';
		
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