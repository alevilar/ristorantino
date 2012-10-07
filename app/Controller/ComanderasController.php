<?php
class ComanderasController extends AppController {

	var $name = 'Comanderas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Comandera->recursive = 0;
		$this->set('comanderas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Comandera.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('comandera', $this->Comandera->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Comandera->create();
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The Comandera has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comandera could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Comandera', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The Comandera has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comandera could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Comandera->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comandera', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comandera->del($id)) {
			$this->Session->setFlash(__('Comandera deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>