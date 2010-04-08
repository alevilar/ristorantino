<?php
class SaboresController extends AppController {

	var $name = 'Sabores';
	var $helpers = array('Html', 'Form');

	function index() {
		if(!empty($this->data)){
			$condiciones = array();
			foreach($this->data as $modelo=>$campos){
				foreach($campos as $key=>$val){
					if(!is_array($val))
						$condiciones[] = array($modelo.".".$key." LIKE"=>'%'.$val.'%');
				}
			}
			$this->Producto->recursive = 0;
			foreach($this->modelNames as $modelo){
				$this->paginate[$modelo] = array(
					'conditions' => $condiciones
				);
			}
		}
		$this->Sabor->recursive = 0;
		
		$sabores = $this->paginate('Sabor');
		
		$this->set('sabores',$sabores);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Sabor.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('sabor', $this->Sabor->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Sabor->create();
			if ($this->Sabor->save($this->data)) {
				$this->Session->setFlash(__('The Sabor has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.', true));
			}
		}
		$categorias = $this->Sabor->Categoria->generatetreelist(null, null, null, '___');
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Sabor', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Sabor->save($this->data)) {
				$this->Session->setFlash(__('The Sabor has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Sabor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Sabor->read(null, $id);
		}
		$categorias = $this->Sabor->Categoria->generatetreelist(null, null, null, '___');
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Sabor', true));
		}
		if ($this->Sabor->del($id)) {
			$this->Session->setFlash(__('Sabor deleted', true));
		}
                $this->redirect(array('action'=>'index'));
	}

}
?>