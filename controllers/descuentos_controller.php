<?php
class DescuentosController extends AppController {

	var $name = 'Descuentos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Descuento->recursive = 0;
		$this->set('descuentos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Descuento.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('descuento', $this->Descuento->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Descuento->create();
			if ($this->Descuento->save($this->data)) {
				$this->Session->setFlash(__('The Descuento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Descuento could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Descuento', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Descuento->save($this->data)) {
				$this->Session->setFlash(__('The Descuento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Descuento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Descuento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Descuento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Descuento->del($id)) {
			$this->Session->setFlash(__('Descuento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>