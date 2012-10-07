<?php
class ReservasController extends AppController {

	var $name = 'Reservas';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Reserva->recursive = 0;
		$this->set('reservas', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Reserva', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('reserva', $this->Reserva->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Reserva->create();
			if ($this->Reserva->save($this->request->data)) {
				$this->Session->setFlash(__('The Reserva has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Reserva could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Reserva', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Reserva->save($this->request->data)) {
				$this->Session->setFlash(__('The Reserva has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Reserva could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Reserva->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Reserva', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Reserva->del($id)) {
			$this->Session->setFlash(__('Reserva deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Reserva could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
?>