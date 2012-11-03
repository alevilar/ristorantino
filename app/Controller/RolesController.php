<?php
App::uses('AppController', 'Controller');
/**
 * Roles Controller
 *
 * @property Rol $Rol
 */
class RolesController extends AppController {


/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Rol->recursive = 0;
		$this->set('roles', $this->paginate());
	}

/**
 * admin_view method
 *
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		$this->Rol->id = $id;
		if (!$this->Rol->exists()) {
			throw new NotFoundException(__('Invalid rol'));
		}
		$this->set('rol', $this->Rol->read(null, $id));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
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
 * admin_edit method
 *
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
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
 * admin_delete method
 *
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
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
