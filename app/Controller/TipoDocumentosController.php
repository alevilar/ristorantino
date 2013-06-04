<?php
class TipoDocumentosController extends AppController {

	var $name = 'TipoDocumentos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->TipoDocumento->recursive = 0;
		$this->set('tipoDocumentos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoDocumento.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoDocumento', $this->TipoDocumento->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->TipoDocumento->create();
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDocumento has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDocumento could not be saved. Please, try again.'));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid TipoDocumento'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDocumento has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDocumento could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoDocumento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoDocumento'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDocumento->delete($id)) {
			$this->Session->setFlash(__('TipoDocumento deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>