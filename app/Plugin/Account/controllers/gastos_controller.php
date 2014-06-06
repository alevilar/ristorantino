<?php


class GastosController extends AccountAppController
{

    var $name = 'Gastos';
    var $helpers = array('Html', 'Form', 'Number', 'Jqm');

    function beforeFilter()
    {
        parent::beforeFilter();
        $this->rutaUrl_for_layout[] = array('name' => 'Contabilidad', 'link' => '/account');
    }

    function index()
    {
        $conds = array();
        if (!empty($this->request->data['Gasto']['proveedor_id'])){
            $conds['Gasto.proveedor_id'] = $this->request->data['Gasto']['proveedor_id'];
        }
        $this->pageTitle = 'Gastos Pendientes de Pago';
        $this->Gasto->recursive = 1;
        $this->Gasto->order = array('Gasto.created ASC');
        $gastos = $this->Gasto->enDeuda($conds);
        $proveedores = $this->Gasto->Proveedor->find('list');
        $this->set('proveedores', $proveedores);
        $this->set('gastos', $gastos );
    }

    function history()
    {
        $this->Gasto->recursive = 0;

        $conditions = array();
        $url = $this->params['url'];
        unset($url['ext']);
        unset($url['url']);

        if ( isset($url['cierre_id']) && $url['cierre_id'] != null ) {
                if ( $url['cierre_id'] == 1) {
                    // Abiertas
                    $conditions[] = 'Gasto.cierre_id IS NULL';
                    $this->request->data['Gasto']['cierre_id'] = $url['cierre_id'];
                } else {               
                    //cerradas
                    $conditions[] = 'Gasto.cierre_id IS NOT NULL';
                    $this->request->data['Gasto']['cierre_id'] = $url['cierre_id'];
                }
        }

        if (!empty($url['fecha_desde'])) {
            $conditions['Gasto.fecha >='] = $url['fecha_desde'];
            $this->request->data['Gasto']['fecha_desde'] = $url['fecha_desde'];
        }
        
        if (!empty($url['importe_neto'])) {
            $conditions['Gasto.importe_neto'] = $url['importe_neto'];
            $this->request->data['Gasto']['importe_neto'] = $url['importe_neto'];
        }

        if (!empty($url['fecha_hasta'])) {
            $conditions['Gasto.fecha <='] = $url['fecha_hasta'];
            $this->request->data['Gasto']['fecha_hasta'] = $url['fecha_hasta'];
        }


        if (empty($url)) {
            $conditions['Gasto.fecha >='] = $this->request->data['Gasto']['fecha_desde'] = date('Y-m-d', strtotime('-1month'));
            $conditions['Gasto.fecha <='] = $this->request->data['Gasto']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }


        if (!empty($url['proveedor_id'])) {
            $conditions['Gasto.proveedor_id'] = $url['proveedor_id'];
            $this->request->data['Gasto']['proveedor_id'] = $url['proveedor_id'];
        }

        if (!empty($url['clasificacion_id'])) {
            $conditions['Gasto.clasificacion_id'] = $url['clasificacion_id'];
            $this->request->data['Gasto']['clasificacion_id'] = $url['clasificacion_id'];
        }

        $this->request->data['Gasto']['tipo_factura_id'] = null;
        if (!empty($url['tipo_factura_id'])) {
            $conditions['Gasto.tipo_factura_id'] = $url['tipo_factura_id'];
            $this->request->data['Gasto']['tipo_factura_id'] = $url['tipo_factura_id'];
        }
           
        $this->set('tipo_facturas', $this->Gasto->TipoFactura->find('list'));
        $this->set('proveedores', $this->Gasto->Proveedor->find('list'));
        $this->set('clasificaciones', $this->Gasto->Clasificacion->find('list'));
        $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('list'));
        
        $ops = array(
            'conditions' => $conditions,
            'recursive' => 1,
        );
        
        $gastos = $this->Gasto->find('all', $ops);
        
        
        $this->set(compact('gastos'));
        
        if ($this->params['url']['ext'] == 'xls' ) {
            $this->layout = 'xls';
            $this->render( 'xls/'.$this->action );
        } 
    }

    function view($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid Gasto', true));
            $this->redirect(array('action' => 'index'));
        }

        $this->Gasto->contain(array(
            'Proveedor',
            'Cierre',
            'Clasificacion',
            'TipoFactura',
            'Egreso' => 'TipoDePago',
            'Impuesto' => 'TipoImpuesto',
        ));

        $this->set('gasto', $this->Gasto->read(null, $id));
    }
    
    
    function add()
    {
        $this->pageTitle = 'Nuevo Gasto';
        if (!empty($this->request->data)) {
            $this->Gasto->create();
            
            if ($this->Gasto->save($this->request->data)) {
                $this->Session->setFlash(__('The Gasto has been saved', true));

                if (!empty($this->request->data['Gasto']['pagar'])) {
                    $this->redirect(array('controller' => 'egresos', 'action' => 'add', $this->Gasto->id));
                } else {
                    $this->redirect(array('controller' => 'gastos', 'action' => 'index'));
                }
            } else {
                $this->Session->setFlash("Error al guardar el gasto");
            }
        }
        
        $this->request->data['Gasto']['fecha'] = date('Y-m-d', strtotime('now'));

        $tipo_facturas = $this->Gasto->TipoFactura->find('list');
        $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('all', array('recursive' => -1)));
        $impuestos = $this->Gasto->Impuesto->find('all');
        $clasificaciones = $this->Gasto->Clasificacion->generatetreelist();
        $proveedores = $this->Gasto->Proveedor->find('list', array(
            'order' => array('Proveedor.name')
                ));
               
        $this->set(compact('proveedores', 'tipo_facturas', 'clasificaciones'));
    }

    function edit($id = null)
    {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Gasto', true));
            $this->redirect(array('action' => 'index'));
        }

        if (!empty($this->request->data)) {
            if ($this->Gasto->save($this->request->data)) {
                $this->Session->setFlash(__('The Gasto has been saved', true));

                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The Gasto could not be saved. Please, try again.', true));
            }
        }

        if (empty($this->request->data)) {
            $this->request->data = $this->Gasto->read(null, $id);
            if ($this->request->data['Gasto']['cierre_id']) {
                $this->Session->setFlash('El gasto ya está "Cerrado", no puede ser modificado');
                $this->redirect(array('action'=>'view', $id));
            }
        }

        if (!empty($this->request->data['Impuesto'])){
            $imps = $this->request->data['Impuesto'];
            $this->request->data['Impuesto'] = array();
            foreach ($imps as $i) {
                $this->request->data['Impuesto'][$i['tipo_impuesto_id']] = $i;
            }
        }
        $this->pageTitle = 'Editar Gasto #' . $id;

        $tipo_facturas = $this->Gasto->TipoFactura->find('list');
        $tipo_impuestos = $this->Gasto->TipoImpuesto->find('all', array('recursive' => -1));
        $impuestos = $this->Gasto->Impuesto->find('all');
        $clasificaciones = $this->Gasto->Clasificacion->generatetreelist();
        $proveedores = $this->Gasto->Proveedor->find('list', array(
            'order' => array('Proveedor.name')
                ));
        $this->set('tipo_impuestos', $tipo_impuestos);
        
        if (!empty($this->request->data['Proveedor']['id'])) {
            $cuit = '';
            if ( !empty($this->request->data['Proveedor']['cuit']) ) {
                $cuit = ' ('.$this->request->data['Proveedor']['cuit'] .')';
            }
            $this->request->data['Gasto']['proveedor_list'] = $this->request->data['Proveedor']['name'].$cuit;
        }
        $this->set(compact('proveedores', 'tipo_facturas', 'clasificaciones'));
        $this->render('add');
    }

    function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Gasto', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Gasto->del($id)) {
            $this->Session->setFlash(__('Gasto deleted', true));
            if ( !$this->request->is('ajax') ) {
                $this->redirect(array('action' => 'index'));
            }
        }
        $this->Session->setFlash(__('The Gasto could not be deleted. Please, try again.', true));
        $this->redirect(array('action' => 'index'));
    }

}

?>