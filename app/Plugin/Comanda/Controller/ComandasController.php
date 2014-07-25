<?php

App::uses('ComandaAppController', 'Comanda.Controller');


class ComandasController extends ComandaAppController {

	public $name = 'Comandas';

    
    
	public function add( $mesa_id = null ){
            
            if (isset($this->request->data)) {                
                $this->Comanda->create();
                if ($this->Comanda->save($this->request->data)) {
                    $this->Session->setFlash( __("Comanda Guardada"), 'flash_success' );
                } else {
                    $this->Session->setFlash(__('The Comanda could not be saved. Please, try again.'), 'flash_error');
                }
                $this->redirect($this->request->data['Comanda']['redirect']);
            } else {
                $this->request->data['Comanda']['redirect'] = $this->referer();
            }
            $this->set('mesa_id', $mesa_id);                 
	}
	
	/**
	 * REimprime comandas
	 * @param integer $id ID de la comanda
	 * @return envia a imprimir
	 */
	public function imprimir( $id ){
		// $this->Printer->imprimirComanda($id);
        $this->Comanda->printEvent(  $id  );
        if ( $this->request->is('ajax') ) {
            exit;
        } else {
            $this->Session->setFlash( __("Se envió a imprimir la comanda"), 'flash_success' );
            $this->redirect($this->referer());
        }
	}


    public function edit ( $id ) {
        if (!empty($this->request->data)) {
            if ( $this->Comanda->save($this->request->data) ) {
                $this->Session->setFlash('Se guardó correctamente la comanda', 'flash_success');
            } else {
                $this->Session->setFlash('Error al guardar la comanda', 'flash_error');
            }
            $this->redirect($this->request->data['Comanda']['redirect']);
        } else {
            $this->request->data = $this->Comanda->read(null, $id);    
            $this->request->data['Comanda']['redirect'] = $this->referer();
        }
        
        $mesas = $this->Comanda->Mesa->find('list', array('conditions'=>array('Mesa.estado_id'=>MESA_ABIERTA)));
        $mesa = $this->request->data['Mesa'];
        $mesas[$mesa['id']] = $mesa['numero'];
        $this->set('mesas', $mesas);
        
    }


    public function delete( $id = null ) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Comanda'), 'flash_error');            
        }
        if ($this->Comanda->delete($id)) {
            $this->Session->setFlash(__('Comanda deleted'), 'flash_success');
        } else {
            $this->Session->setFlash(__('No se pudo eliminar la Comanda'), 'flash_error');
        }
        if ($this->request->is('ajax')) {
            return 1;
        } 
        $this->redirect($this->referer());
    }

}
