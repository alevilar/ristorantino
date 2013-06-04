<?php

App::uses('AppController', 'Controller');

/**
 * TipoDePagos Controller
 *
 * @property TipoDePago $TipoDePago
 */
class TipoDePagosController extends AppController
{

    public $helpers = array(
        'FileUpload.FileUpload',
    );
    

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->set('folder_tipo_de_pagos', $this->TipoDePago->imageFolderName);
    }

    /**
     * index method
     *
     * @return void
     */
    public function index()
    {
        $this->TipoDePago->recursive = 0;
        $this->set('tipoDePagos', $this->paginate());
    }

    /**
     * view method
     *
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        $this->TipoDePago->id = $id;
        $this->TipoDePago->recursive = -1;
        if (!$this->TipoDePago->exists()) {
            throw new NotFoundException(__('Invalid tipo de pago'));
        }
        $this->set('tipoDePago', $this->TipoDePago->read(null, $id));
        $this->set('folder_tipo_de_pagos', $this->TipoDePago->imageFolderName);
    }

    /**
     * add method
     *
     * @return void
     */
    public function add_edit($id)
    {
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->TipoDePago->save($this->request->data)) {
                $this->Session->setFlash(__('The tipo de pago has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The tipo de pago could not be saved. Please, try again.'));
            }
        }
        $this->TipoDePago->recursive = -1;
        $this->request->data = $this->TipoDePago->read(null, $id);
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->TipoDePago->id = $id;
        if (!$this->TipoDePago->exists()) {
            throw new NotFoundException(__('Invalid tipo de pago'));
        }
        if ($this->TipoDePago->delete()) {
            $this->Session->setFlash(__('Tipo de pago deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Tipo de pago was not deleted'));
        $this->redirect(array('action' => 'index'));
    }

}
