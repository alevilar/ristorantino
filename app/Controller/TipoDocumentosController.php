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
			$this->Session->setFlash(__('Invalid TipoDocumento.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoDocumento', $this->TipoDocumento->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->TipoDocumento->create();
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDocumento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDocumento could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid TipoDocumento', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->TipoDocumento->save($this->request->data)) {
				$this->Session->setFlash(__('The TipoDocumento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDocumento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->TipoDocumento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoDocumento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDocumento->del($id)) {
			$this->Session->setFlash(__('TipoDocumento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>