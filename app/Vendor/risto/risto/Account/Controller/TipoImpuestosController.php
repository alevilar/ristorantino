<?php

App::uses('AccountAppController', 'Account.Controller');


class TipoImpuestosController extends AccountAppController {

	var $name = 'TipoImpuestos';
	

    
        
	function index() {
		$this->TipoImpuesto->recursive = 0;
		$this->set('tipoImpuestos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoImpuesto'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoImpuesto', $this->TipoImpuesto->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->TipoImpuesto->create();
			if ($this->TipoImpuesto->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoImpuesto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoImpuesto could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid TipoImpuesto'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->TipoImpuesto->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoImpuesto has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoImpuesto could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoImpuesto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoImpuesto'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->TipoImpuesto->delete($id)) {
			$this->Session->setFlash(__('TipoImpuesto deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The TipoImpuesto could not be deleted. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

}
?>