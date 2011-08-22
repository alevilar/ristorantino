<?php

class ValesController extends AccountAppController {

    var $name = 'Vales';
    var $helpers = array('Html', 'Form');
    var $uses = array('Vale');
    var $components = array('Printer', 'RequestHandler');


    function beforeFilter() {
            parent::beforeFilter();
            $this->rutaUrl_for_layout[] =array('name'=> 'Contabilidad','link'=>'/account' );
    }    
    
    function index() {
        $this->Vale->recursive = 0;
        $this->Vale->order = array('Vale.created' => 'DESC');
        $this->set('vales', $this->paginate());
    }

    function add() {
        $this->rutaUrl_for_layout[] =array('name'=> 'Vales','link'=>'/account/vales' );
        if (!empty($this->data)) {
            $this->Vale->create();
            if ($this->Vale->save($this->data)) {
                $this->Session->setFlash(__('El vale ha sido creado', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El vale no se ha podido guardar. Por favor, intente nuevamente.', true));
            }
        }
    }

    function edit($id = null) {
        $this->rutaUrl_for_layout[] =array('name'=> 'Vales','link'=>'/account/vales' );
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Vale', true));
            $this->redirect(array('action' => 'index'));
        }
        if (!empty($this->data)) {
            if ($this->Vale->save($this->data)) {
                $this->Session->setFlash(__('El vale ha sido guardado', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El vale no se ha podido guardar. Por favor, intente nuevamente.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Vale->read(null, $id);
        }
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Vale', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Vale->del($id)) {
            $this->Session->setFlash(__('El vale ha sido eliminado', true));
            $this->redirect(array('action' => 'index'));
        }
    }

}
