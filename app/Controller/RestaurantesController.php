<?php
class RestaurantesController extends AppController {

	var $name = 'Restaurantes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Restaurante->recursive = 0;
		$this->set('restaurantes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Restaurante.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('restaurante', $this->Restaurante->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Restaurante->create();
			if ($this->Restaurante->save($this->request->data)) {
				$this->Session->setFlash(__('The Restaurante has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Restaurante could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Restaurante'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Restaurante->save($this->request->data)) {
				$this->Session->setFlash(__('The Restaurante has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Restaurante could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Restaurante->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Restaurante'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Restaurante->delete($id)) {
			$this->Session->setFlash(__('Restaurante deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>