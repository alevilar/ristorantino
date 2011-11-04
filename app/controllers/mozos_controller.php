<?php
class MozosController extends AppController {

	var $name = 'Mozos';
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

        /**
         * Me devuelve las mesas abiertas de cada mozo
         * @param boolean $microtime microtime desde donde yo quiero tomar omo referencia a la hora de traer las mesas
         */
        function mesas_abiertas($microtime = 0) {
            
            $mesas = array();
            $lastAccess = null;
            if ( !empty($microtime) ) {
                $lastAccess = date('Y-m-d H:i:s', microtime($microtime));
                
                if ( $this->Session->check('lastAccess') ) {
                    $lastAccess = $this->Session->read('lastAccess');
                }
            }
            $mesas = $this->Mozo->mesasAbiertas(null, $lastAccess); 

            $mozosMesa = array();
            foreach ( $mesas as $key=>$abmMesas ) {
                $i = 0;
                foreach ( $abmMesas as $m ) {
                    if ( !empty($m['Mesa']) ) {
                        $m['Mozo']['mesas'] = $m['Mesa'];
                        $mozosMesa[$key]['mozos'][] = $m['Mozo'];
                        $i++;
                    }
                }
            }
            $mesas = $mozosMesa;
            $lastAccess = date('Y-m-d H:i:s', strtotime('now'));
            $this->Session->write('lastAccess', $lastAccess );
            $this->set('mesasLastUpdatedTime', microtime()  );
            $this->set('mesas', $mesas);
        }

}
?>