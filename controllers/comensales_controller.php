<?php
class ComensalesController extends AppController {

	var $name = 'Comensales';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Comensal->recursive = 0;
		$this->set('comensales', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comensal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comensal', $this->Comensal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Comensal->create();
			if ($this->Comensal->save($this->data)) {
				$this->Session->setFlash(__('The Comensal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comensal could not be saved. Please, try again.', true));
			}
		}
		$mesas = $this->Comensal->Mesa->find('list');
		$this->set(compact('mesas'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Comensal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Comensal->save($this->data)) {
				$this->Session->setFlash(__('The Comensal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comensal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Comensal->read(null, $id);
		}
		$mesas = $this->Comensal->Mesa->find('list');
		$this->set(compact('mesas'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comensal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comensal->del($id)) {
			$this->Session->setFlash(__('Comensal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>