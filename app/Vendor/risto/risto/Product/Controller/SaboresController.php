<?php

App::uses('ProductAppController', 'Product.Controller');


class SaboresController extends ProductAppController {

	public $name = 'Sabores';
	public $helpers = array('Html', 'Form');
        
        
    public $components = array(        
        'Search.Prg',
        'Paginator', 
        );

        
	public function index() {
		$this->Prg->commonProcess();
        $conds = $this->Sabor->parseCriteria( $this->Prg->parsedParams() );
        $this->Paginator->settings['conditions'] = $conds;

		$this->Sabor->recursive = 0;
		
		$sabores = $this->Paginator->paginate('Sabor');
		
		$this->set('sabores',$sabores);
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sabor.'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('sabor', $this->Sabor->read(null, $id));
	}

	public function add() {
            
		if (!empty($this->request->data)) {
			$this->Sabor->create();
			if ($this->Sabor->save($this->request->data)) {
				$this->Session->setFlash(__('The Sabor has been saved'), 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.'), 'flash_success');
			}
		}
		$categorias = $this->Sabor->Categoria->generateTreeList(null, null, null, '___');
		$this->set(compact('categorias'));
		$this->render('form');
	}

	public function edit($id = null) {
            
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Sabor'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Sabor->save($this->request->data)) {
				$this->Session->setFlash(__('The Sabor has been saved'), 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.'), 'flash_error');
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Sabor->read(null, $id);
		}
		$categorias = $this->Sabor->Categoria->generateTreeList(null, null, null, '___');
		$this->set(compact('categorias'));
		$this->render('form');
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sabor'), 'flash_error');
		}
		if ($this->Sabor->delete($id)) {
			$this->Session->setFlash(__('Sabor deleted'), 'flash_success');
		}
                $this->redirect(array('action'=>'index'));
	}

}
?>