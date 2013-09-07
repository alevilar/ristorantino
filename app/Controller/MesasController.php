<?php

App::uses('Printaitor', 'PrinterEngine.Utility');

class MesasController extends AppController
{

    public $helpers = array('Html', 'Form');
    public $components = array('Search.Prg', 'RequestHandler');


    /* @var $Printer PrinterComponent */
    public $Printer;
    public $paginate = array(
        'paramType' => 'querystring'
    );

    private $aplanar = false; // aplana la mesa on BeforeRender
    
    public function beforeRender()
    {       
        if ($this->aplanar) {
            if ( !empty($this->viewVars['mesa']) ) {
                $this->viewVars['mesa'] = aplanar_mesa($this->viewVars['mesa']);
            }
            if ( !empty($this->viewVars['mesas']) ) {
                $this->viewVars['mesas'] = aplanar_mesas($this->viewVars['mesas']);
            }
        }
        return parent::beforeRender();
    }
    
    
    public function index($estado = null)
    {
        if ($this->request->is('ajax')) {
            $mesas = $this->Mesa->getAbiertas(null);
            $this->aplanar = true;
        } else {
            $this->Prg->commonProcess();
            $this->paginate['conditions'] = $this->Mesa->parseCriteria($this->passedArgs);
            $this->request->data['Mesa'] = $this->passedArgs;

            if (!empty($estado)) {
                switch ($estado) {
                    case 'abiertas':
                    case 'abierta':
                        $condiciones['Mesa.estado_id'] = MESA_ABIERTA;
                        break;
                    case 'cerradas':
                    case 'cerrada':
                        $condiciones['Mesa.estado_id'] = MESA_CERRADA;
                        break;
                    case 'cobradas':
                    case 'cobrada':
                        $condiciones['Mesa.estado_id'] = MESA_COBRADA;
                        break;
                    default:
                        break;
                }
            }
            $mesas = $this->paginate();
        }
        $this->set('mesas', $mesas);
        $this->set('estados', $this->Mesa->estados);
        $this->set('_serialize', array('mesas'));
    }

    public function view($id = null)
    {
        $this->pageTitle = 'Mesa N° ' . $mesa['Mesa']['numero'];

        if (!$id) {
            $this->Session->setFlash(__('Invalid Mesa.'));
            $this->redirect(array('action' => 'index'));
        }

        $this->Mesa->id = $id;


        $mesa = $this->Mesa->find('first', array(
            'conditions' => array('Mesa.id' => $id),
            'contain' => array(
                'Mozo',
                'Cliente',
                'Comanda' => array(
                    'DetalleComanda' => array(
                        'Producto',
                        'DetalleSabor.Sabor'
                    )
            ))
                ));

        $cont = 0;

        $this->set(array(
            'mesa_total' => $this->Mesa->getTotal(),
            'mesa' => $mesa,
            '_serialize' => array('mesa'),
        ));
    }

    /**
     * Cierra la mesa, calculando el total y, si se lo indica,
     * imprime el ticket fiscal.
     * @param type $mesa_id
     * @param type $imprimir_ticket
     * @return type 
     */
    public function cerrarMesa($mesa_id, $imprimir_ticket = true)
    {
        if (empty($mesa_id)) {
            throw new InternalErrorException("Se debe pasar el ID de la mesa por cerrar");
            return;
        }

        $retData = $this->Mesa->cerrar_mesa($mesa_id);
        if (!empty($retData)) {
            $retData = $this->Mesa->getDataParaFiscal($mesa_id);
            $data = array(
                'items'                 =>  $retData['Items'],
                'porcentaje_descuento'  =>  $retData['Totales']['descuento'],
                'total'                 =>  $retData['Totales']['total'],
                'mozo'                  =>  $retData['Mesa']['mozo_numero'],
                'mesa'                  =>  $retData['Mesa']['numero'],
                'tipo_factura'          =>  !empty($retData['Cliente']['IvaResponsabilidad']['TipoFactura']['codename'])?$retData['Cliente']['IvaResponsabilidad']['TipoFactura']['codename']:'"B"',
            );

            Printaitor::send($data, 'Fiscal', 'ticket');
        }


        if (!$this->RequestHandler->isAjax()) {
            $this->redirect($this->referer());
        } else {
            $this->aplanar = true;
        }
        $this->set('mesa', $this->Mesa->read(null, $mesa_id));
        $this->set('_serialize', array('mesa'));
    }

    public function imprimirTicket($mesa_id)
    {

        if (empty($mesa_id)) {
            throw new InternalErrorException("Se debe pasar el ID de la mesa por cerrar");
            return;
        }

        $retData = $this->Mesa->getDataParaFiscal($mesa_id);
        
        $data = array(
            'items'                 =>  $retData['Items'],
            'porcentaje_descuento'  =>  $retData['Totales']['descuento'],
            'total'                 =>  $retData['Totales']['total'],
            'mozo'                  =>  $retData['Mesa']['mozo_numero'],
            'mesa'                  =>  $retData['Mesa']['numero'],
            'tipo_factura'          =>  !empty($retData['Cliente']['IvaResponsabilidad']['TipoFactura']['codename'])?$retData['Cliente']['IvaResponsabilidad']['TipoFactura']['codename']:'"B"',
        );

        Printaitor::send($data, 'Fiscal', 'ticket');
        
        $this->autoRender = false;
        return "Ok";
    }

    public function add()
    {
        if ($this->request->is('post')) {
            $this->Mesa->create();
            if ($this->Mesa->save($this->request->data)) {
                $this->Session->setFlash(__('The mesa has been saved'));
                if (!$this->request->is('ajax')) {
                    $this->redirect(array('action' => 'index'));
                }
                $mesa = $this->Mesa->read();
                $this->aplanar = true;
                $this->set(array(
                    'mesa' => $mesa,
                    'validationErrors' => $this->Mesa->validationErrors,
                ));
            } else {
                $this->Session->setFlash(__('The mesa could not be saved. Please, try again.'));
            }
            
        } else {

            $mozos = $this->Mesa->Mozo->find('list', array('fields' => array('id', 'numero_y_nombre')));
            $tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');
            $descuentos = $this->Mesa->Descuento->find('list');
            $estados = $this->Mesa->estados;
            $this->set('mesa', 'Error');
            $this->set(compact('mozos', 'descuentos', 'tipo_pagos', 'estados'));
            
        }
    }


    public function edit($id = null)
    {
        $this->Mesa->id = $id;
        if (!$this->Mesa->exists()) {
            throw new NotFoundException(__('Invalid mesa'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if (isset($this->request->data['Mozo'])) {
                unset($this->request->data['Mozo']);
            }
            if (isset($this->request->data['Comanda'])) {
                unset($this->request->data['Comanda']);
            }
            if (isset($this->request->data['Descuento'])) {
                unset($this->request->data['Descuento']);
            }
            if (isset($this->request->data['Cliente'])) {
                unset($this->request->data['Cliente']);
            }
            if ($this->Mesa->save($this->request->data)) {
                $this->Session->setFlash(__('The mesa has been saved'));
                if (!$this->request->is('ajax')) {
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The mesa could not be saved. Please, try again.'));
            }
        }

        $mesa = $this->request->data = $this->Mesa->find('first', array(
            'conditions' => array(
                'Mesa.id' => $this->Mesa->id),
            'contain' => array(
                'Mozo',
                'Descuento',
                'Cliente' => 'Descuento',
                'Estado',
                'Comanda' => array(
                    'DetalleComanda' => array(
                        'Producto',
                        'DetalleSabor' => 'Sabor'
                    )
                )
            )
                ));
        $tot = $this->Mesa->calcular_totales($this->Mesa->id);
        foreach($tot['Mesa'] as $k=>$v) {
            $mesa['Mesa'][$k] = $v;
        }
        $items = $this->request->data['Comanda'];
        $mozos = $this->Mesa->Mozo->find('list', array(
            'fields' => array('id', 'numero_y_nombre'),
            'conditions' => array('Mozo.activo' => 1),
                ));
        $this->aplanar = true;
        $this->set('subtotal', $this->Mesa->getSubtotal());
        $this->set('total', $this->Mesa->getTotal());
        $this->set('estados', $this->Mesa->estados);
        $this->set('title_for_layout', 'Editando la Mesa ' . $mesa['Mesa']['numero']);
        $this->set(compact('mesa', 'items', 'mozos'));
        $this->set('_serialize', array('mesa'));
    }

    /**
     * delete method
     *
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Mesa->id = $id;
        if (!$this->Mesa->exists()) {
            throw new NotFoundException(__('Invalid mesa'));
        }
        if ($this->Mesa->delete()) {
            $this->Session->setFlash(__('Mesa deleted'));
            $this->redirect(array('action' => 'index'));
            $this->set("mensaje", 'Mesa Borrada');
        } else {
            $this->set("mensaje", 'Mesa Borrada');
            $this->Session->setFlash(__('Mesa was not deleted'));
        }

        if (!$this->request->is('ajax')) {
            $this->redirect($this->referer());
        }
        $this->set("_serialize", array('mensaje'));
    }

    public function cerradas()
    {
        $mesas = $this->Mesa->todasLasCerradas();
        $this->set('mesas', $mesas);
        $this->render('mesas');
    }

    public function cobradas()
    {
        if ($this->request->is('ajax')) {
            $this->layout= 'jqm';
        }
        $mesas = $this->Mesa->ultimasCobradas();
        $this->set('title_for_layout', 'Últimas Mesas Cobradas');

        $newMes = array();
        $cont = 0;
        foreach ($mesas as $m) {
            $newMes[$cont] = $m['Mesa'];
            $newMes[$cont]['Mozo'] = $m['Mozo'];
            $newMes[$cont]['Comanda'] = $m['Comanda'];
            $newMes[$cont]['Descuento'] = $m['Descuento'];
            $cont++;
        }        
        $this->aplanar = true;
        $this->set('mesas', $newMes);
    }

    public function abiertas()
    {
        $options = array(
            'conditions' => array(
                "Mesa.time_cobro" => "0000-00-00 00:00:00",
                "Mesa.time_cerro" => "0000-00-00 00:00:00",
            ),
            'order' => 'Mesa.created DESC',
            'contain' => array(
                'Mozo',
                'Cliente' => 'Descuento',
                'Comanda'
            )
        );

        $mesas = $this->Mesa->find('all', $options);
        $this->set('mesas', $mesas);
        $this->render('mesas');
    }

    public function reabrir($id)
    {
        if ($this->Mesa->reabrir($id)) {
            $this->Session->setFlash('Se reabrió la mesa', true);
        } else {
            $this->Session->setFlash('Error al reabrir la mesa', true);
        }
        if (!$this->request->is('ajax')) {
            $this->redirect($this->referer());
        } else {
            $this->autoRender = false;
            echo "Se reabrio la mesa";
        }
    }

    public function addClienteToMesa($mesa_id, $cliente_id = 0)
    {
        if ($cliente_id) {
            $this->Mesa->Cliente->contain(array(
                'Descuento',
            ));
            $this->set('cliente', $this->Mesa->Cliente->read(null, $cliente_id));
        } else {
            $this->set('cliente', array());
        }


        $this->Mesa->id = $mesa_id;
        if ($this->Mesa->saveField('cliente_id', $cliente_id)) {
            $this->Session->setFlash('Se agregó un cliente a la mesa', true);
        }
    }

}

?>