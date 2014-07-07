<?php
App::uses('RistoAppController', 'Risto.Controller');
/**
 * IvaResponsabilidades Controller
 *
 * @property IvaResponsabilidad $IvaResponsabilidad
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class IvaResponsabilidadesController extends RistoAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->IvaResponsabilidad->recursive = 0;
		$this->set('ivaResponsabilidades', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->IvaResponsabilidad->exists($id)) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		$options = array('conditions' => array('IvaResponsabilidad.' . $this->IvaResponsabilidad->primaryKey => $id));
		$this->set('ivaResponsabilidad', $this->IvaResponsabilidad->find('first', $options));
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
				$this->Session->setFlash(__('The iva responsabilidad has been saved.'));
				return $this->redirect(array('action' => 'index'));
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
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->IvaResponsabilidad->exists($id)) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->IvaResponsabilidad->save($this->request->data)) {
				$this->Session->setFlash(__('The iva responsabilidad has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The iva responsabilidad could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('IvaResponsabilidad.' . $this->IvaResponsabilidad->primaryKey => $id));
			$this->request->data = $this->IvaResponsabilidad->find('first', $options);
		}
		$tipoFacturas = $this->IvaResponsabilidad->TipoFactura->find('list');
		$this->set(compact('tipoFacturas'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->IvaResponsabilidad->id = $id;
		if (!$this->IvaResponsabilidad->exists()) {
			throw new NotFoundException(__('Invalid iva responsabilidad'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->IvaResponsabilidad->delete()) {
			$this->Session->setFlash(__('The iva responsabilidad has been deleted.'));
		} else {
			$this->Session->setFlash(__('The iva responsabilidad could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}}
