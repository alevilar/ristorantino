<?php
App::uses('AppController', 'Controller');
/**
 * GrupoSabores Controller
 *
 * @property GrupoSabor $GrupoSabor
 */
class GrupoSaboresController extends AppController {


/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->GrupoSabor->recursive = 0;
		$this->set('grupoSabores', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->GrupoSabor->id = $id;
		if (!$this->GrupoSabor->exists()) {
			throw new NotFoundException(__('Invalid grupo sabor'));
		}
		$this->set('grupoSabor', $this->GrupoSabor->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GrupoSabor->create();
			if ($this->GrupoSabor->save($this->request->data)) {
				$this->Session->setFlash(__('The grupo sabor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo sabor could not be saved. Please, try again.'));
			}
		}
		$productos = $this->GrupoSabor->Producto->find('list');
		$this->set(compact('productos'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->GrupoSabor->id = $id;
		if (!$this->GrupoSabor->exists()) {
			throw new NotFoundException(__('Invalid grupo sabor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->GrupoSabor->save($this->request->data)) {
				$this->Session->setFlash(__('The grupo sabor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The grupo sabor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->GrupoSabor->read(null, $id);
		}
		$productos = $this->GrupoSabor->Producto->find('list');
		$this->set(compact('productos'));
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
		$this->GrupoSabor->id = $id;
		if (!$this->GrupoSabor->exists()) {
			throw new NotFoundException(__('Invalid grupo sabor'));
		}
		if ($this->GrupoSabor->delete()) {
			$this->Session->setFlash(__('Grupo sabor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Grupo sabor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
