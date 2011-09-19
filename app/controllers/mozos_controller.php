<?php
class MozosController extends AppController {

	var $name = 'Mozos';
        var $components = array('Actualizador');
	var $helpers = array('Html', 'Form');

        function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Admin','link'=>'/pages/administracion' );
        }
        
	function index() {
		$this->Mozo->recursive = 0;
		$this->set('mozos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Mozo.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('mozo', $this->Mozo->read(null, $id));
		/*$this->layout='frames';*/
	}

	function add() {
            $this->rutaUrl_for_layout[] =array('name'=> 'Mozos','link'=>'/mozos' );
		if (!empty($this->data)) {
			//$this->Mozo->create();

                        
			if ($this->Mozo->saveAll($this->data)) {
				$this->Session->setFlash(__('The Mozo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Mozo could not be saved. Please, try again.', true));
			}
		}
		
		$users = $this->Mozo->User->find('list',array('fields'=>array('id','username'), 'conditions'=> array('User.role'=>'mozo')));
		
		$this->set(compact('users'));
	}

	function edit($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Mozos','link'=>'/mozos' );
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Mozo', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Mozo->save($this->data)) {
				$this->Session->setFlash(__('The Mozo has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Mozo could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Mozo->read(null, $id);
		}
		
		$users = $this->Mozo->User->find('list',array('fields'=>array('id','username'), 'conditions'=> array('User.role'=>'mozo')));
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Mozo', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Mozo->del($id)) {
			$this->Session->setFlash(__('Mozo deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}


        function mesas_abiertas() {
            $mesas = array();
            if ( $this->Actualizador->huboCambios() ) {
                $mesas = $this->Mozo->mesasAbiertas();                
                $this->Actualizador->reset();
            }            
//            $this->Actualizador->actualizar();
            $this->set('mesas', $mesas);
        }

}
?>