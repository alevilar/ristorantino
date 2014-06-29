<?php

App::uses('MesaAppController', 'Mesa.Controller');

class MozosController extends MesaAppController {

    public $paginate = array(
        'limit' => 40,
        'order' => array(
            'Mozo.activo' => 'desc',
            'Mozo.numero' => 'asc',
        )
    );
    

    public function beforeFilter() {
        parent::beforeFilter();
    }
        
	function index() {
		$this->Mozo->recursive = 0;
		$this->set('mozos', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Mozo.'), 'flash_error');
			$this->redirect(array('action'=>'index'));
		}
		$this->set('mozo', $this->Mozo->read(null, $id));
		/*$this->layout='frames';*/
	}

	public function add() {
		if (!empty($this->request->data)) {
			if ($this->Mozo->save($this->request->data)) {
				$this->Session->setFlash(__('The Mozo has been saved'), 'flash_success');
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Mozo could not be saved. Please, try again.'),'flash_error');
			}
		}
		$this->render('edit');
	}

        
        
                
	public function edit($id = null) {
		$this->Mozo->id = $id;
		if (!$this->Mozo->exists()) {
			throw new NotFoundException(__('Invalid mozo'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Mozo->save($this->request->data)) {
				$this->Session->setFlash(__('The mozo has been saved'), 'flash_success');
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The mozo could not be saved. Please, try again.'),'flash_error');
			}
		} else {
			$this->request->data = $this->Mozo->read(null, $id);
		}
		
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Mozo'));
			$this->redirect(array('action'=>'index'),'flash_error');
		}
		if ($this->Mozo->delete($id)) {
			$this->Session->setFlash(__('Mozo deleted'),'flash_success');
			$this->redirect(array('action'=>'index'));
		}
	}

        /**
         * Me devuelve las mesas abiertas de cada mozo
         * @param boolean $microtime microtime desde donde yo quiero tomar omo referencia a la hora de traer las mesas
         */
        public function mesas_abiertas( $microtime = 0 ) {
            
            $lastAccess = null;
            if ( $microtime != 0 ) {
                $lastAccess = $this->Session->read('lastAccess');

                // setear el nuevo lastAccess
                $nowTime = date('Y-m-d H:i:s', strtotime('now'));
                $this->Session->write('lastAccess', $nowTime );
            }

            $mesas = $this->Mozo->mesasAbiertas(null, $lastAccess);             

            $this->set('mesasLastUpdatedTime', 1 );
            $this->set('modified', $lastAccess );
            $this->set('mesas', array('created' => $mesas));
            
        }

}
?>