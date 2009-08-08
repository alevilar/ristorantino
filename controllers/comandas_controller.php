<?php
class ComandasController extends AppController {

	var $name = 'Comandas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Comanda->recursive = 0;
		$this->set('comandas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comanda.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comanda', $this->Comanda->read(null, $id));
	}

	
	function add(){
		$this->autoRender = false;
		//Configure::write('debug',0);
		
		if (isset($this->data)):
			$guardar = $this->data['Comanda'];
		echo "----- la cantiadd de cosas a imprimir se guardaran: ".sizeof($guardar)." ---- <br>";
			for ($i=0 ; $i < sizeof($guardar) ; $i++):
				$this->data['Comanda'] = $guardar[$i]; 
				
				if ($this->Comanda->guardar($this->data)) {					
					$j;
				} else {
					$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
				}
			endfor;
		endif;
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comanda->save($this->data)) {
				$this->Session->setFlash(__('The Comanda has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comanda->read(null, $id);
		}
		$productos = $this->Comanda->Producto->find('list');
		$mesas = $this->Comanda->Mesa->find('list');
		$this->set(compact('productos','mesas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comanda', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comanda->del($id)) {
			$this->Session->setFlash(__('Comanda deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>