<?php

class MesasController extends AppController
{

    public $helpers = array('Html', 'Form');
    public $components = array('Printer', 'Search.Prg', 'RequestHandler');


    /* @var $Printer PrinterComponent */
    public $Printer;
    public $paginate = array(
        'paramType' => 'querystring'
    );

    public function index($estado = null)
    {
        $lastAccess = null;
        if ($this->request->is('ajax')) {

            $microtime = $estado;
            if ($microtime != 0) {
                $lastAccess = $this->Session->read('lastAccess');
            }
            $mesas = $this->Mesa->getAbiertas(null, $lastAccess);
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
        $this->set('modified', $lastAccess);
        $this->set('mesas', $mesas);
        $this->set('estados', $this->Mesa->estados);
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

        $this->Mesa->id = $mesa_id;

        if ($imprimir_ticket) {
            $this->Printer->doPrint($mesa_id);
        }

        $retData = $this->Mesa->cerrar_mesa();

        if ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            debug($retData);
            return 1;
        } else {
            $this->redirect($this->referer());
        }
    }

    public function imprimirTicket($mesa_id)
    {

        $this->Mesa->imprimirTicket($mesa_id);

        if ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            return 1;
        } else {
            $this->flash('Se imprimio comanda de mesa ID: ' . $mesa_id . ' (click para reimprimir)', $this->request->action . '/' . $mesa_id);
            $this->redirect($this->referer());
        }
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
                $this->set(array(
                    'mesa'=> $mesa['Mesa'],
                    'insertedId' => $this->Mesa->getLastInsertId(),
                    'validationErrors' => $this->Mesa->validationErrors,
                ));
            } else {
                $this->Session->setFlash(__('The mesa could not be saved. Please, try again.'));
                $this->set('mesa', 'Error');
            }
            $this->set('_serialize', 'mesa');
        } else {

            $mozos = $this->Mesa->Mozo->find('list', array('fields' => array('id', 'numero_y_nombre')));
            $tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');
            $descuentos = $this->Mesa->Descuento->find('list');
            $estados = $this->Mesa->estados;
            $this->set(compact('mozos', 'descuentos', 'tipo_pagos', 'estados'));
        }
    }

    /**
     * Esta accion edita cualquiera de los campos de la mesa,
     * pero hay que pasar en la variabla $this->request->data el ID de
     * la mesa si o si para que funcione
     *
     * @return boolean 1 on success 0 fail
     */
    public function ajax_edit()
    {
        $this->autoRender = false;
        $returnFlag = 1;

        if (!empty($this->request->data)) {
            if (isset($this->request->data['Mesa']['id'])) {
                if (($this->request->data['Mesa']['id'] != '') || ($this->request->data['Mesa']['id'] != null) || ($this->request->data['Mesa']['id'] != 0)) {
                    $this->Mesa->recursive = -1;
                    $this->Mesa->id = $this->request->data['Mesa']['id'];

                    foreach ($this->request->data['Mesa'] as $field => $valor):
                        if ($field == 'id')
                            continue; // el id no lo tengo que actualizar
                        $valor = (strtolower($valor) == 'now()') ? strftime('%Y-%m-%d %H:%M:%S', time()) : $valor;
                        if (!$this->Mesa->saveField($field, $valor, $validate = true)) {
                            debug($this->Mesa->validationErrors);
                            header("HTTP/1.0 500 Internal Server Error");
                            if ($returnFlag == 1) {
                                $returnFlag = 0;
                            }
                            $returnFlag--;
                        }
                    endforeach;
                }
            } else {
                header("HTTP/1.0 500 Internal Server Error");
            }
        } else {
            header("HTTP/1.0 500 Internal Server Error");
        }
        return $returnFlag;
    }

    public function edit($id = null)
    {

        $this->Mesa->id = $id;
        if (!$this->Mesa->exists()) {
            throw new NotFoundException(__('Invalid mesa'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->Mesa->save($this->request->data)) {
                $this->Session->setFlash(__('The mozo has been saved'));
                if (!$this->request->is('ajax')) {
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash(__('The mozo could not be saved. Please, try again.'));
            }
        }

        $mesa = $this->request->data = $this->Mesa->find('first', array(
            'conditions' => array(
                'Mesa.id' => $id),
            'contain' => array(
                'Mozo',
                'Cliente' => 'Descuento',
                'Comanda' => array(
                    'DetalleComanda' => array(
                        'Producto',
                        'DetalleSabor' => 'Sabor'
                    )
                )
            )
                ));

        $items = $this->request->data['Comanda'];
        $mozos = $this->Mesa->Mozo->find('list', array(
            'fields' => array('id', 'numero_y_nombre'),
            'conditions' => array('Mozo.activo' => 1),
                ));

        $this->id = $id;
        $this->set('subtotal', $this->Mesa->getSubtotal());
        $this->set('total', $this->Mesa->getTotal());
        $this->set('estados', $this->Mesa->estados);
        $this->set(compact('mesa', 'items', 'mozos'));
        $this->set('title_for_layout', 'Editando la Mesa ' . $mesa['Mesa']['numero']);
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