<?php
App::uses('AppController', 'Controller');
/**
 * TipoFacturas Controller
 *
 * @property TipoFactura $TipoFactura
 */
class TipoFacturasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TipoFactura->recursive = 0;
		$this->set('tipoFacturas', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->TipoFactura->id = $id;
		if (!$this->TipoFactura->exists()) {
			throw new NotFoundException(__('Invalid tipo factura'));
		}
		$this->set('tipoFactura', $this->TipoFactura->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TipoFactura->create();
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo factura has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo factura could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->TipoFactura->id = $id;
		if (!$this->TipoFactura->exists()) {
			throw new NotFoundException(__('Invalid tipo factura'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->TipoFactura->save($this->request->data)) {
				$this->Session->setFlash(__('The tipo factura has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The tipo factura could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->TipoFactura->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->TipoFactura->id = $id;
		if (!$this->TipoFactura->exists()) {
			throw new NotFoundException(__('Invalid tipo factura'));
		}
		if ($this->TipoFactura->delete()) {
			$this->Session->setFlash(__('Tipo factura deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Tipo factura was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
