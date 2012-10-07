<?php
class DescuentosController extends AppController {

	public $helpers = array('Html', 'Form');
        public $components = array('Session');
        

       function beforeFilter() {
            parent::beforeFilter();
        }
        
	function index() {
		$this->Descuento->recursive = 0;
		$this->set('descuentos', $this->paginate());
	}
        
	function all_descuentos() {
		$this->Descuento->recursive = 0;
                $conds = array();
                
                if ( $this->Session->read('Auth.User.role') == 'mozo' ) {
                    $descMax = Configure::read('Mozo.descuento_maximo');
                    if ( isset($descMax) ) {
                        $conds['Descuento.porcentaje <='] = $descMax;
                    }
                }
                
                $descs = $this->Descuento->find('all', array(
                    'conditions' => $conds
                ));
		$this->set('descuentos', $descs);
	}
        

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Descuento.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('descuento', $this->Descuento->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
			$this->Descuento->create();
			if ($this->Descuento->save($this->request->data)) {
				$this->Session->setFlash(__('The Descuento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Descuento could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Descuento', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Descuento->save($this->request->data)) {
				$this->Session->setFlash(__('The Descuento has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Descuento could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Descuento->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Descuento', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Descuento->del($id)) {
			$this->Session->setFlash(__('Descuento deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>