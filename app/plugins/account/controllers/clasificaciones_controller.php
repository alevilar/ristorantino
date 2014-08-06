<?php

class ClasificacionesController extends AccountAppController
{

    var $scaffold;

    function index()
    {
        $this->set('clasificaciones', $this->Clasificacion->generatetreelist(null, null, null, '____'));
    }

    function add_edit($id = null)
    {

        if (!empty($this->data)) {
            if ($this->Clasificacion->save($this->data)) {
                $this->Session->setFlash('La clasificacion ha sido guardada');
            } else {
                $this->Session->setFlash('Error al guardar la clasificación');
            }
        }

        if (!empty($id)) {
            $this->Clasificacion->recursive = 0;
            $this->data = $this->Clasificacion->read(null, $id);
        }

        $this->set('clasificacion_id', $id);

        $treelist = $this->Clasificacion->generatetreelist();
        $this->set('clasificaciones', $treelist);
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Clasificacion', true));
        }
        if ($this->Clasificacion->del($id)) {
            $this->Session->setFlash(__('Clasificacion deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function gastos()
    {
        $conditions = array();
        $url = $this->params['url'];
        unset($url['ext']);
        unset($url['url']);

        if ( isset($url['cierre_id']) && $url['cierre_id'] != null ) {
                if ( $url['cierre_id'] == 1) {
                    // Abiertas
                    $conditions[] = 'Gasto.cierre_id IS NULL';
                    $this->data['Gasto']['cierre_id'] = $url['cierre_id'];
                } else {               
                    //cerradas
                    $conditions[] = 'Gasto.cierre_id IS NOT NULL';
                    $this->data['Gasto']['cierre_id'] = $url['cierre_id'];
                }
        }

        if (!empty($url['fecha_desde'])) {
            $conditions['Gasto.fecha >='] = $url['fecha_desde'];
            $this->data['Gasto']['fecha_desde'] = $url['fecha_desde'];
        }

        if (!empty($url['fecha_hasta'])) {
            $conditions['Gasto.fecha <='] = $url['fecha_hasta'];
            $this->data['Gasto']['fecha_hasta'] = $url['fecha_hasta'];
        }
        
        if (empty($url)) {
            $conditions['Gasto.fecha >='] = $this->data['Gasto']['fecha_desde'] = date('Y-m-d', strtotime('-1month'));
            $conditions['Gasto.fecha <='] = $this->data['Gasto']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }

        $this->set('resumen_x_clasificacion', $this->Clasificacion->gastos($conditions));
        $this->set('clasificaciones', $this->Clasificacion->find('list'));
        $this->set('proveedores', $this->Clasificacion->Gasto->Proveedor->find('list'));
    }

}
