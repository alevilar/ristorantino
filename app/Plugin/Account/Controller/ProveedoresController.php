<?php

App::uses('AccountAppController', 'Account.Controller');


class ProveedoresController extends AccountAppController {

	public $name = 'Proveedores';

	public $components = array('Paginator', 'RequestHandler');
	// public $helpers = array('Html', 'Form');

     
        
        
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
			$this->Session->setFlash(__('Invalid Proveedor', true));
			$this->redirect($arrayName = array('' => , );('action' => 'index'));
		}
		$this->set('proveedor', $this->Proveedor->read(null, $id));
	}

	public function add() {
		if (!empty($this->request->data)) {
			$this->Proveedor->create();
			if ($this->Proveedor->save($this->request->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved', true));
                                unset($this->request->data);
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit($id = null) {
            $this->rutaUrl_for_layout[] =array('name'=> 'Proveedores','link'=>'/account/proveedores' );
		if (!$id && empty($this->request->data)) {
			$this->Session->setFlash(__('Invalid Proveedor', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->request->data)) {
			if ($this->Proveedor->save($this->request->data)) {
				$this->Session->setFlash(__('The Proveedor has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Proveedor could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->request->data)) {
			$this->request->data = $this->Proveedor->read(null, $id);
		}
	}

	public function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Proveedor', true));
			$this->redirect(array('action' => 'index'));
		}
		if ($this->Proveedor->delete($id)) {
			$this->Session->setFlash(__('Proveedor deleted', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('The Proveedor could not be deleted. Please, try again.', true));
		$this->redirect(array('action' => 'index'));
	}

}
