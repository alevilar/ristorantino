<?php
class TipoDePagosController extends AppController {

	var $name = 'TipoDePagos';
	var $helpers = array('Html', 'Form');

       function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
	function index() {
		$this->TipoDePago->recursive = 0;
		$this->set('tipoDePagos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid TipoDePago.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tipoDePago', $this->TipoDePago->read(null, $id));
	}

	function add() {
            $this->rutaUrl_for_layout[] =array('name'=> 'Tipo de pagos','link'=>'/TipoDePagos' );
		if (!empty($this->data)) {
			$this->TipoDePago->create();
			if ($this->TipoDePago->save($this->data)) {
				$this->Session->setFlash(__('The TipoDePago has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDePago could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
             $this->rutaUrl_for_layout[] =array('name'=> 'Tipo de pagos','link'=>'/TipoDePagos' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid TipoDePago', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->TipoDePago->save($this->data)) {
				$this->Session->setFlash(__('The TipoDePago has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The TipoDePago could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->TipoDePago->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for TipoDePago', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->TipoDePago->del($id)) {
			$this->Session->setFlash(__('TipoDePago deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>