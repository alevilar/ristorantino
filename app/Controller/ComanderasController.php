<?php
App::uses('AppController', 'Controller');
/**
 * Comanderas Controller
 *
 * @property ComanderasController $Comandera
 */
class ComanderasController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Comandera->recursive = 0;
		$this->set('comanderas', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Comandera->id = $id;
		if (!$this->Comandera->exists()) {
			throw new NotFoundException(__('Invalid comandera'));
		}
		$this->set('comandera', $this->Comandera->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Comandera->create();
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The comandera has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comandera could not be saved. Please, try again.'));
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
		$this->Comandera->id = $id;
		if (!$this->Comandera->exists()) {
			throw new NotFoundException(__('Invalid comandera'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Comandera->save($this->request->data)) {
				$this->Session->setFlash(__('The comandera has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The comandera could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Comandera->read(null, $id);
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
		$this->Comandera->id = $id;
		if (!$this->Comandera->exists()) {
			throw new NotFoundException(__('Invalid comandera'));
		}
		if ($this->Comandera->delete()) {
			$this->Session->setFlash(__('Comandera deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Comandera was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
