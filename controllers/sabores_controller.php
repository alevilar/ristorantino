<?php
class SaboresController extends AppController {

	var $name = 'Sabores';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Sabor->recursive = 0;
		$this->set('sabores', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sabor.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('sabor', $this->Sabor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sabor->create();
			if ($this->Sabor->save($this->data)) {
				$this->Session->setFlash(__('The Sabor has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.', true));
			}
		}
		$categorias = $this->Sabor->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Sabor', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sabor->save($this->data)) {
				$this->Session->setFlash(__('The Sabor has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sabor->read(null, $id);
		}
		$categorias = $this->Sabor->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sabor', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Sabor->del($id)) {
			$this->Session->setFlash(__('Sabor deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>