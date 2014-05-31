<?php

App::uses('UserAppController', 'User.Controller');

class MozosController extends UserAppController {

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
            }
            $mesas = $this->Mozo->mesasAbiertas(null, $lastAccess); 
                     
            $mozosMesa = array();
            foreach ( $mesas as $key=>$abmMesas ) {
                $i = 0;
                foreach ( $abmMesas as $m ) {
//                    debug($m);
                    // si es la primera vez que pido esta action, entonces me trae a TODOS los mozos del array
                    // caso contrario solo me traera los mozos que tienen alguna mesa donde se haya realizado algun cambio
                    if ( !empty($lastAccess) ) {
                        // solo mandar un array con los mozos que tienen mesas modificadas despues del $lastAccess
                        if ( !empty($m['Mesa']) ) {  
                            $m['Mozo']['mesas'] = $m['Mesa'];
                            $mozosMesa[$key]['mozos'][] = $m['Mozo'];
                            $i++;
                        }
                    } else {
                        // traer todos los mozos, con su array de mesas
                        $m['Mozo']['mesas'] = $m['Mesa'];
                        $mozosMesa[$key]['mozos'][] = $m['Mozo'];
                        $i++;
                    }
                }
            }
//            debug( $mozosMesa );
            if ( !empty( $mozosMesa ) ) {
                $nowTime = date('Y-m-d H:i:s', strtotime('now'));
                $this->Session->write('lastAccess', $nowTime );
//                debug( $this->Session->read('lastAccess') );
            }
            
            $this->set('mesasLastUpdatedTime', 1 );
            $this->set('modified', $lastAccess );
            $this->set('mesas', $mozosMesa);
            
        }

}
?>