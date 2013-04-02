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

        if (!empty($url['closed'])) {
            $conditions['Gasto.closed'] = $url['closed'] - 1;
            $this->data['Gasto']['closed'] = $url['closed'];
        }

        if (!empty($url['mes'])) {
            $conditions['MONTH(Gasto.fecha)'] = $url['mes'];
            $this->data['Gasto']['mes'] = $url['mes'];
        }

        if (!empty($url['anio'])) {
            $conditions['YEAR(Gasto.fecha)'] = $url['anio'];
            $this->data['Gasto']['anio'] = $url['anio'];
        }
        
        if (empty($url)) {
            $this->data['Gasto']['mes'] = date('m', strtotime('now'));
            $this->data['Gasto']['anio'] = date('Y', strtotime('now'));
            $conditions['MONTH(Gasto.fecha)'] = $this->data['Gasto']['mes'];
            $conditions['YEAR(Gasto.fecha)'] = date('Y', strtotime('now'));
        }

        $this->set('resumen_x_clasificacion', $this->Clasificacion->gastos($conditions));
        $this->set('clasificaciones', $this->Clasificacion->find('list'));
    }

}
