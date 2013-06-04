<?php
class PagosController extends AppController {

	var $name = 'Pagos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Pago->recursive = 0;
		$this->set('pagos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Pago.'));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('pago', $this->Pago->read(null, $id));
	}

	function add() {
		if (!empty($this->request->data)) {
                    if (!empty($this->request->data['Mesa'])) {
                        $this->request->data['Mesa']['estado_id'] = MESA_COBRADA;
                        $this->request->data['Mesa']['time_cobro'] = date( "Y-m-d H:i:s", strtotime('now'));
                        $this->Pago->Mesa->save($this->request->data['Mesa']);
                    }
                    
                    if ( !empty( $this->request->data['Pago'] ) && count($this->request->data['Pago']) == 1 && empty($this->request->data['Pago'][0]['valor']) ) {
                        if (!empty($this->request->data['Mesa'])) {
                            $total_pagado = $this->Pago->Mesa->getTotal($this->request->data['Mesa']['id']);
                            $this->request->data['Pago'][0]['valor'] = $total_pagado;
                        }                    
                        
                        if ($this->Pago->saveAll($this->request->data['Pago'])) {				
                            $this->Session->setFlash(__('The Pago has been saved'));
                        } else {
                            $this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
                        }
                    }
                    
                    
		}
                if (!$this->RequestHandler->isAjax()) {
                    $this->redirect($this->referer());
                } else {
                    die(1);
                }
	}

	function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Pago'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Pago->save($this->request->data)) {
				$this->Session->setFlash(__('The Pago has been saved'));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pago could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Pago->read(null, $id);
		}
		$mesas = $this->Pago->Mesa->find('list');
		$tipoDePagos = $this->Pago->TipoDePago->find('list');
		$this->set(compact('mesas','tipoDePagos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Pago'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pago->delete($id)) {
			$this->Session->setFlash(__('Pago deleted'));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>