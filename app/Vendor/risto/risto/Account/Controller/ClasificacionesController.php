<?php

App::uses('AccountAppController', 'Account.Controller');

class ClasificacionesController extends AccountAppController
{

    var $scaffold;

    function index()
    {
        $this->set('clasificaciones', $this->Clasificacion->generateTreeList());
    }

    function add_edit($id = null)
    {        
        $this->Clasificacion->recover();
        if ( $this->request->is('post') || $this->request->is('put') ) {            
            if ( $this->Clasificacion->save( $this->request->data ) ) {
                $this->Session->setFlash('La clasificacion ha sido guardada');
            } else {
                $this->Session->setFlash('Error al guardar la clasificación', 'flash_error');
            }
        }

        if (!empty($id)) {
            $this->Clasificacion->recursive = 0;
            $this->request->data = $this->Clasificacion->read(null, $id);
        }

        $this->set('clasificacion_id', $id);

        $treelist = $this->Clasificacion->generateTreeList();
        $this->set('clasificaciones', $treelist);
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Clasificacion', true));
        }
        if ($this->Clasificacion->delete($id)) {
            $this->Session->setFlash(__('Clasificacion deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function gastos()
    {
        $this->Prg->commonProcess('Clasificacion', array('paramType' => 'querystring'));
        $conditions = $this->Clasificacion->Gasto->parseCriteria( $this->request->query );
        $this->Prg->presetForm('Clasificacion');
        
        $this->set('resumen_x_clasificacion', $this->Clasificacion->gastos($conditions));
        $this->set('clasificaciones', $this->Clasificacion->find('list'));
        $this->set('proveedores', $this->Clasificacion->Gasto->Proveedor->find('list'));
    }

}
