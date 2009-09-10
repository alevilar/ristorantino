<?php
class ClientesController extends AppController {

	var $name = 'Clientes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Cliente->recursive = 0;
		$this->set('clientes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Cliente.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('cliente', $this->Cliente->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Cliente->User->create();
			$this->Cliente->create();
			if ($this->Cliente->saveAll($this->data)) {
				$this->Session->setFlash(__('Se agregó un nuevo cliente', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser gardado, intente nuevamente.', true));
			}
		}
		$users = $this->Cliente->User->find('list');
		$descuentos = $this->Cliente->Descuento->find('list');
		$this->set(compact('users', 'descuentos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Cliente incorrecto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Cliente->saveAll($this->data)) {
				$this->Session->setFlash(__('El Cliente fue guardado', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('El Cliente no pudo ser guardado.intente nuevamente.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Cliente->read(null, $id);
		}
		$users = $this->Cliente->User->find('list');
		$descuentos = $this->Cliente->Descuento->find('list');
		$this->set(compact('users','descuentos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Cliente', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Cliente->del($id)) {
			$this->Session->setFlash(__('Cliente deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>