<?php
class TipoImpuestosController extends AppController {

	var $name = 'TipoImpuestos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->TipoImpuesto->recursive = 0;
		$this->set('tipoImpuestos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoImpuesto', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoImpuesto', $this->TipoImpuesto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->TipoImpuesto->create();
			if ($this->TipoImpuesto->save($this->data)) {
				$this->Session->setFlash(__('The TipoImpuesto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoImpuesto could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid TipoImpuesto', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoImpuesto->save($this->data)) {
				$this->Session->setFlash(__('The TipoImpuesto has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoImpuesto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoImpuesto->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoImpuesto', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->TipoImpuesto->del($id)) {
			$this->Session->setFlash(__('TipoImpuesto deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The TipoImpuesto could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>