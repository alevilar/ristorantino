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
			$this->Session->setFlash(__('Invalid Pago.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('pago', $this->Pago->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
                    if (!empty($this->data['Mesa'])) {
                        $this->data['Mesa']['estado_id'] = MESA_COBRADA;
                        $this->data['Mesa']['time_cobro'] = date( "Y-m-d H:i:s", strtotime('now'));
                        $this->Pago->Mesa->save($this->data['Mesa']);
                    }
                    
                    if ( !empty( $this->data['Pago'] ) && count($this->data['Pago']) == 1 && empty($this->data['Pago'][0]['valor']) ) {
                        if (!empty($this->data['Mesa'])) {
                            $total_pagado = $this->Pago->Mesa->calcular_total($this->data['Mesa']['id']);
                            $this->data['Pago'][0]['valor'] = $total_pagado;
                        }                    
                        
                        if ($this->Pago->saveAll($this->data['Pago'])) {				
                            $this->Session->setFlash(__('The Pago has been saved', true));
                        } else {
                            $this->Session->setFlash(__('The Pago could not be saved. Please, try again.', true));
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
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Pago', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pago->save($this->data)) {
				$this->Session->setFlash(__('The Pago has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Pago could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pago->read(null, $id);
		}
		$mesas = $this->Pago->Mesa->find('list');
		$tipoDePagos = $this->Pago->TipoDePago->find('list');
		$this->set(compact('mesas','tipoDePagos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Pago', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pago->del($id)) {
			$this->Session->setFlash(__('Pago deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>