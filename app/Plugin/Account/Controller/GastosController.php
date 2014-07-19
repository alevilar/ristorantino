<?php

App::uses('AccountAppController', 'Account.Controller');

class GastosController extends AccountAppController
{

    public $name = 'Gastos';
    

    public $components = array(     
        'RequestHandler',  
        'Search.Prg',
        'Paginator', 
        );


  
    public function index()
    {
        $this->Prg->commonProcess('Gasto', array('paramType' => 'querystring'));
        $this->Prg->presetForm('Gasto');
        $conditions = $this->Gasto->parseCriteria( $this->Prg->parsedParams() );
        
        // $this->pageTitle = 'Gastos Pendientes de Pago';
        $this->Gasto->recursive = 1;
        $this->Gasto->order = array('Gasto.created ASC');
        $gastos = $this->Gasto->enDeuda($conditions);
        $proveedores = $this->Gasto->Proveedor->find('list');
        $this->set('proveedores', $proveedores);
        $this->set('gastos', $gastos );
    }

    public function history()
    {
        $this->Prg->commonProcess('Gasto', array('paramType' => 'querystring'));
        $this->Prg->presetForm('Gasto');
        $conditions = $this->Gasto->parseCriteria( $this->Prg->parsedParams() );

        if ( !array_key_exists('Gasto.fecha >=', $conditions) && !array_key_exists('Gasto.fecha <=', $conditions)) {
            $conditions['Gasto.fecha >='] = $this->request->data['Gasto']['fecha_desde'] = date('Y-m-d', strtotime('-1 month'));
            $conditions['Gasto.fecha <='] = $this->request->data['Gasto']['fecha_hasta'] = date('Y-m-d', strtotime('now'));
        }

        $tp = $this->Gasto->TipoFactura->find('list');
        $this->set('tipo_facturas', $tp);

        $this->set('proveedores', $this->Gasto->Proveedor->find('list'));
        $this->set('clasificaciones', $this->Gasto->Clasificacion->find('list'));
        $this->set('tipo_impuestos', $this->Gasto->TipoImpuesto->find('list'));
        
        $ops = array(
            'conditions' => $conditions,
            'recursive' => 1,
        );
        
        $gastos = $this->Gasto->find('all', $ops);
        
        $this->set(compact('gastos'));
    }



    public function view($id = null)
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
    
    
    public function add()
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
        $clasificaciones = $this->Gasto->Clasificacion->generateTreeList();
        $proveedores = $this->Gasto->Proveedor->find('list', array(
            'order' => array('Proveedor.name')
                ));
               
        $this->set(compact('proveedores', 'tipo_facturas', 'clasificaciones'));
        $this->render('form');
    }

    public function edit($id = null)
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

        $tipoFacturas = $this->Gasto->TipoFactura->find('list');
        $tipo_impuestos = $this->Gasto->TipoImpuesto->find('all', array('recursive' => -1));
        $impuestos = $this->Gasto->Impuesto->find('all');
        $clasificaciones = $this->Gasto->Clasificacion->generateTreeList();
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
        $this->set(compact('proveedores', 'tipoFacturas', 'clasificaciones'));
        $this->render('form');
    }

    public function delete($id = null)
    {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Gasto', true));
            $this->redirect(array('action' => 'index'));
        }
        if ($this->Gasto->delete($id)) {
            $this->Session->setFlash(__('Gasto deleted', true));
            if ( !$this->RequestHandler->isAjax() ) {
                $this->redirect(array('action' => 'index'));
            }
        }
        $this->Session->setFlash(__('The Gasto could not be deleted. Please, try again.', true));
        $this->redirect(array('action' => 'index'));
    }

}

?>