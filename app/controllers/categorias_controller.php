<?php
class CategoriasController extends AppController {

	var $name = 'Categorias';
	var $helpers = array('Html', 'Form','Cache');
	
	
	
	//var $layout;
        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
        
	function index() {
		$this->Categoria->recursive = 0;	
		$this->set('categorias',$this->Categoria->generatetreelist(null, null, null, '&nbsp;&nbsp;&nbsp;'));	
	}
	
	
	/**
	 * 
	 * Reordena el arbol alfabeticamente y devuelve a la pagtalla index
	 * 
	 */
	function reordenar() { 
		$this->Categoria->reorder(array('field' => 'Categoria.name', 'order' => 'ASC' ));	
		$this->redirect(array('action'=>'index'));	
	}
	
	

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Categoria.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('categoria', $this->Categoria->read(null, $id));
	}

	function add() {
            $this->rutaUrl_for_layout[] =array('name'=> 'Categorias','link'=>'/categorias' );
		Cache::delete('categorias');
		if (!empty($this->data)) {
			$this->Categoria->create();
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('The Categoria has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Categoria could not be saved. Please, try again.', true));
			}
		}
		
		$categorias = $this->Categoria->generatetreelist(null, null, null, '-- ');
		$this->set(compact('categorias'));
	}

        function recover() {
            debug($this->Categoria->recover());
            exit();
        }

        function verify() {
            debug($this->Categoria->verify());
            exit();
        }

	function edit($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Categorias','link'=>'/categorias' );
		Cache::delete('categorias');
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Categoria', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Categoria->save($this->data)) {
				$this->Session->setFlash(__('The Categoria has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Categoria could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Categoria->read(null, $id);
		}
		$this->set('categorias', $this->Categoria->generatetreelist(null, null, null, '-- '));
	}

	function delete($id = null) {
		Cache::delete('categorias');
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Categoria', true));
		}
		if ($this->Categoria->del($id)) {
			$this->Session->setFlash(__('Categoria deleted', true));
		}
                $this->redirect(array('action'=>'index'));
	}
	
	
	function listar(){
            $this->cacheAction = true;		
            $categorias = $this->Categoria->array_listado();
            $this->set('categorias', $categorias);
	}
}
?>