<?php
class ProveedoresController extends AppController {

	var $name = 'Proveedores';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Proveedor->recursive = 0;
		$this->set('proveedores', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Proveedor', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('proveedor', $this->Proveedor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Proveedor->create();
			if ($this->Proveedor->save($this->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Proveedor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Proveedor->save($this->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Proveedor->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Proveedor', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Proveedor->del($id)) {
			$this->Session->setFlash(__('Proveedor deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Proveedor could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>