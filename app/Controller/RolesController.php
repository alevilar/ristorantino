<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Rol $Rol
 */
class RolesController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Rol->recursive = 0;
		$this->set('roles', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Rol->id = $id;
		if (!$this->Rol->exists()) {
			throw new NotFoundException(__('Invalid rol'));
		}
		$this->set('rol', $this->Rol->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Rol->create();
			if ($this->Rol->save($this->request->data)) {
				$this->Session->setFlash(__('The rol has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rol could not be saved. Please, try again.'));
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
		$this->Rol->id = $id;
		if (!$this->Rol->exists()) {
			throw new NotFoundException(__('Invalid rol'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Rol->save($this->request->data)) {
				$this->Session->setFlash(__('The rol has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rol could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Rol->read(null, $id);
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
		$this->Rol->id = $id;
		if (!$this->Rol->exists()) {
			throw new NotFoundException(__('Invalid rol'));
		}
		if ($this->Rol->delete()) {
			$this->Session->setFlash(__('Rol deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rol was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
