<?php
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
		if (!empty($this->data)) {
			$this->Rol->create();
			if ($this->Rol->save($this->data)) {
				$this->Session->setFlash(__('The rol has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rol could not be saved. Please, try again.'), array('class'=>'alert alert-danger'));
			}
		}
                $this->render('edit');
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
		if (!empty($this->data)) {
			if ($this->Rol->save($this->data)) {
				$this->Session->setFlash(__('The rol has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The rol could not be saved. Please, try again.'));
			}
		} else {
			$this->data = $this->Rol->read(null, $id);
		}
	}

/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Rol->id = $id;
		if (!$this->Rol->exists()) {
			throw new NotFoundException(__('Invalid rol', true));
		}
		if ($this->Rol->delete()) {
			$this->Session->setFlash(__('Rol deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Rol was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
