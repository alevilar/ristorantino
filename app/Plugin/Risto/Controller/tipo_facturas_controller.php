<?php
class TipoFacturasController extends AppController {

	var $name = 'TipoFacturas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->TipoFactura->recursive = 0;
		$this->set('tipoFacturas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoFactura', $this->TipoFactura->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->TipoFactura->create();
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoFactura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoFactura could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoFactura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoFactura could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoFactura->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->TipoFactura->del($id)) {
			$this->Session->setFlash(__('TipoFactura deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The TipoFactura could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}


	function admin_index() {
		$this->TipoFactura->recursive = 0;
		$this->set('tipoFacturas', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('tipoFactura', $this->TipoFactura->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->request->data)) {
			$this->TipoFactura->create();
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoFactura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoFactura could not be saved. Please, try again.', true));
			}
		}
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoFactura has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The TipoFactura could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoFactura->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoFactura', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->TipoFactura->del($id)) {
			$this->Session->setFlash(__('TipoFactura deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The TipoFactura could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>