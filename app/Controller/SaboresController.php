<?php
App::uses('AppController', 'Controller');
/**
 * Sabores Controller
 *
 * @property Sabor $Sabor
 */
class SaboresController extends AppController {

    public $components = array('Search.Prg');
    
    public $paginate;
    
    public $presetVars = true; // using the model configuration
    
/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->Sabor->recursive = 0;
                $this->Prg->commonProcess();
                $this->paginate['conditions'] = $this->Sabor->parseCriteria($this->passedArgs);
		$this->set('sabores', $this->paginate());
	}

/**
 * view method
 *
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		$this->Sabor->id = $id;
		if (!$this->Sabor->exists()) {
			throw new NotFoundException(__('Invalid sabor'));
		}
		$this->set('sabor', $this->Sabor->read(null, $id));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Sabor->create();
			if ($this->Sabor->save($this->request->data)) {
				$this->Session->setFlash(__('The sabor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sabor could not be saved. Please, try again.'));
			}
		}
		$categorias = $this->Sabor->Categoria->find('list');
		$this->set(compact('categorias'));
	}

/**
 * edit method
 *
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		$this->Sabor->id = $id;
		if (!$this->Sabor->exists()) {
			throw new NotFoundException(__('Invalid sabor'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Sabor->save($this->request->data)) {
				$this->Session->setFlash(__('The sabor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The sabor could not be saved. Please, try again.'));
			}
		} else {
			$this->request->data = $this->Sabor->read(null, $id);
		}
		$categorias = $this->Sabor->Categoria->find('list');
		$this->set(compact('categorias'));
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
		$this->Sabor->id = $id;
		if (!$this->Sabor->exists()) {
			throw new NotFoundException(__('Invalid sabor'));
		}
		if ($this->Sabor->delete()) {
			$this->Session->setFlash(__('Sabor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Sabor was not deleted'));
		$this->redirect(array('action' => 'index'));
	}
}
