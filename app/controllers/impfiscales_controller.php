<?php
class ImpfiscalesController extends AppController {

	var $name = 'Impfiscales';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Impfiscal->recursive = 0;
		$this->set('impfiscales', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Impfiscal.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('impfiscal', $this->Impfiscal->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Impfiscal->create();
			if ($this->Impfiscal->save($this->data)) {
				$this->Session->setFlash(__('The Impfiscal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Impfiscal could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Impfiscal', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Impfiscal->save($this->data)) {
				$this->Session->setFlash(__('The Impfiscal has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Impfiscal could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Impfiscal->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Impfiscal', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Impfiscal->del($id)) {
			$this->Session->setFlash(__('Impfiscal deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>