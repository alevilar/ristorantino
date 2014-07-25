<?php

App::uses('AccountAppController', 'Account.Controller');


class ProveedoresController extends AccountAppController {

	public $name = 'Proveedores';

        
        
	public function index () {
		$this->Proveedor->recursive = 0;                
        if ( !empty($this->request->data['Proveedor']['buscar_proveedor'])) {
            $this->Paginator->settings['conditions']['or']['UPPER(Proveedor.name) LIKE'] = "%".strtoupper($this->request->data['Proveedor']['buscar_proveedor'])."%";
            $this->Paginator->settings['conditions']['or']['Proveedor.cuit LIKE'] = "%".$this->request->data['Proveedor']['buscar_proveedor']."%";
        }
        if ($this->request->is('ajax')) {
            $this->Paginator->settings['limit'] = 999;
        }
		$this->set('proveedores', $this->paginate());
	}

	public function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Proveedor'));
			$this->redirect($this->referer());
		}
		$this->set('proveedor', $this->Proveedor->read(null, $id));
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Proveedor->create();
			if ($this->Proveedor->save($this->request->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved'));
                                unset($this->request->data);
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.'));
			}
		}
	}

	public function edit($id = null) {
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Proveedor'), 'flash_error');
			$this->redirect(array('action' => 'index'));
		}
		if ( $this->request->is('put') || $this->request->is('post') ) {
			if ($this->Proveedor->save($this->request->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.'));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Proveedor->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Proveedor'));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Proveedor->delete($id)) {
			$this->Session->setFlash(__('Proveedor deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Proveedor could not be deleted. Please, try again.'));
		$this->redirect(array('action' => 'index'));
	}

}
