<?php
App::uses('AppController', 'Controller');
/**
 * IvaResponsabilidades Controller
 *
 * @property IvaResponsabilidad $IvaResponsabilidad
 */
class IvaResponsabilidadesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->IvaResponsabilidad->recursive = 0;
		$this->set('ivaResponsabilidades', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->IvaResponsabilidad->id = $id;
		if (!$this->IvaResponsabilidad->exists()) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		$this->set('ivaResponsabilidad', $this->IvaResponsabilidad->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->IvaResponsabilidad->create();
			if ($this->IvaResponsabilidad->save($this->request->data)) {
				$this->Session->setFlash(__('The iva responsabilidad has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The iva responsabilidad could not be saved. Please, try again.'));
			}
		}
		$tipoFacturas = $this->IvaResponsabilidad->TipoFactura->find('list');
		$this->set(compact('tipoFacturas'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->IvaResponsabilidad->id = $id;
		if (!$this->IvaResponsabilidad->exists()) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->IvaResponsabilidad->save($this->request->data)) {
				$this->Session->setFlash(__('The iva responsabilidad has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The iva responsabilidad could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->IvaResponsabilidad->read(null, $id);
		}
		$tipoFacturas = $this->IvaResponsabilidad->TipoFactura->find('list');
		$this->set(compact('tipoFacturas'));
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
		$this->IvaResponsabilidad->id = $id;
		if (!$this->IvaResponsabilidad->exists()) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		if ($this->IvaResponsabilidad->delete()) {
			$this->Session->setFlash(__('Iva responsabilidad deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Iva responsabilidad was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
