<?php
class ProductosController extends AppController {

	var $name = 'Productos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Producto->recursive = 0;
		$this->set('productos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Producto.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('producto', $this->Producto->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Producto->create();
			if ($this->Producto->save($this->data)) {
				$this->Session->setFlash(__('The Producto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}
		$categorias = $this->Producto->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Producto', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Producto->save($this->data)) {
				$this->Session->setFlash(__('The Producto has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Producto could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Producto->read(null, $id);
		}
		$categorias = $this->Producto->Categoria->find('list');
		$this->set(compact('categorias'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Producto', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Producto->del($id)) {
			$this->Session->setFlash(__('Producto deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>