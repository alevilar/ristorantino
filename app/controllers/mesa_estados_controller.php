<?php
class MesaEstadosController extends AppController {

	var $name = 'MesaEstados';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->MesaEstado->recursive = 0;
		$this->set('mesaEstados', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid MesaEstado', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('mesaEstado', $this->MesaEstado->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->MesaEstado->create();
			if ($this->MesaEstado->save($this->data)) {
				$this->Session->setFlash(__('The MesaEstado has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The MesaEstado could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid MesaEstado', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->MesaEstado->save($this->data)) {
				$this->Session->setFlash(__('The MesaEstado has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The MesaEstado could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->MesaEstado->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for MesaEstado', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->MesaEstado->del($id)) {
			$this->Session->setFlash(__('MesaEstado deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The MesaEstado could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>