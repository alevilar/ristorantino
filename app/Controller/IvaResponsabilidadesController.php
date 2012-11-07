<?php
class IvaResponsabilidadesController extends AppController {

	var $name = 'IvaResponsabilidades';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->IvaResponsabilidad->recursive = 0;
		$this->set('ivaResponsabilidades', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid IvaResponsabilidad.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('ivaResponsabilidad', $this->IvaResponsabilidad->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->IvaResponsabilidad->create();
			if ($this->IvaResponsabilidad->save($this->request->data)) {
				$this->Session->setFlash(__('The IvaResponsabilidad has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The IvaResponsabilidad could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid IvaResponsabilidad'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->IvaResponsabilidad->save($this->request->data)) {
				$this->Session->setFlash(__('The IvaResponsabilidad has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The IvaResponsabilidad could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->IvaResponsabilidad->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for IvaResponsabilidad'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->IvaResponsabilidad->del($id)) {
			$this->Session->setFlash(__('IvaResponsabilidad deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>