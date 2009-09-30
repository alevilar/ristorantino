<?php
class DetalleComandasController extends AppController {

	var $name = 'DetalleComandas';
	var $helpers = array('Html', 'Form');

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
		
		
		$this->DetalleComanda->Comanda->create();
			if($this->DetalleComanda->Comanda->save($this->data['Comanda'])){
				$ok = true;
			}
		unset($this->data['Comanda']);
		
		debug($this->data);
		foreach($this->data as $data):
			$data['DetalleComanda']['comanda_id'] = $this->DetalleComanda->Comanda->id;
			
			if ($this->DetalleComanda->saveAll($data)){
				$ok = true;
			}
			else {
				$ok = false;
				break;
			}
			
		endforeach;
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