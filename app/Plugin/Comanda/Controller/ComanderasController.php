<?php

App::uses('ComandaAppController', 'Comanda.Controller');

class ComanderasController extends ComandaAppController {

	public $name = 'Comanderas';
	public $helpers = array('Html', 'Form');

	public function index() {
		$this->Comandera->recursive = 0;
		$this->set('comanderas', $this->paginate());
	}
	

	public function add() {
		if (!empty($this->request->data)) {
			$this->Comandera->create();
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The Comandera has been saved'), 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comandera could not be saved. Please, try again.'), 'flash_success');
			}
		}
		$this->render('form');
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Comandera'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The Comandera has been saved'), 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Comandera could not be saved. Please, try again.', 'flash_error'), 'flash_success');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Comandera->read(null, $id);
		}
		$this->render('form');
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Comandera'), 'flash_success');
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Comandera->delete($id)) {
			$this->Session->setFlash(__('Comandera deleted'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>