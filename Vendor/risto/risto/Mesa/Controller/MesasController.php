<?php

App::uses('MesaAppController', 'Mesa.Controller');




class MesasController extends MesaAppController {

    var $name = 'Mesas';


    public $paginate = array(
        'order' => array('Mesa.created' => 'asc'),
        // 'paramType' => 'querystring',
    );
    
    var $estados = array(
        1 => "Abierta",
        2 => "Cerrada",
        3 => "Cobrada",
        );


    
    public function index() {
        $this->Prg->commonProcess();
        $conds = $this->Mesa->parseCriteria( $this->Prg->parsedParams() );

        $this->Paginator->settings['conditions'] = $conds;
        $this->Paginator->settings['contain'] = array(
            'Mozo(numero)',
            'Cliente' => array('Descuento')
        );

        
        if (!empty($this->request->data['Mesa']['exportar_excel'])){
            $this->Paginator->settings['limit'] = null;
            $this->set('mesas', $this->Mesa->find('all', array(
                'conditions' => $conds,
                'contain' => $this->Paginator->settings['contain']
                 )
            ));
            $this->layout = 'xls';
            $this->render('xls/index');
        }

        
        $this->set('mesas', $this->Paginator->paginate('Mesa'));

        $tot = $this->Mesa->find('first', array(
            'conditions' => $conds,
            'fields' => array('sum(Mesa.total) as total'),
            ));
        $tot = empty($tot['0']['total']) ? 0 : $tot['0']['total'];
        $this->set('mesas_suma_total', money_format('%.2n', $tot) );
        $this->set('estados', $this->estados);

    }


    public function view($id = null) {

        if (!$id) {
            $this->Session->setFlash(__('Invalid Mesa.'));
            $this->redirect(array('action'=>'index'));
        }

        $this->Mesa->id = $id;
        $items = $this->Mesa->listado_de_productos();


        //$mesa = $this->Mesa->read(null, $id);
        $mesa = $this->Mesa->find('first',array(
                'conditions'=>array('Mesa.id'=>$id),
                'contain'=>array(
                        'Mozo(id,numero)',
                        'Cliente(id,nombre,imprime_ticket,tipofactura)',
                        'Comanda(id,prioridad,observacion)')
        ));

        $cont = 0;
        //debug($items);
        //Mezco el array $items que contiene Producto-DetalleComanda- y todo lo que venga delacionado al array $items lo mete como si fuera Producto
        // esto es porque en el javascript trato el ProductoCOmanda como DetalleComanda
        foreach ($items as $d):
            foreach($d as $coso) {
                foreach($coso as $dcKey=>$dvValue) {
                    $mesa['Producto'][$cont][$dcKey] = $dvValue;
                }
            }
            $mesa['Producto'][$cont]['cantidad'] 	= $d['DetalleComanda']['cant'];
            $mesa['Producto'][$cont]['name'] 		= $d['Producto']['name'];
            $mesa['Producto'][$cont]['id'] 	 		= $d['DetalleComanda']['id'];
            $mesa['Producto'][$cont]['producto_id'] = $d['Producto']['id'];
            $cont++;
        endforeach;

        $this->pageTitle = 'Mesa N° '.$mesa['Mesa']['numero'];
        $this->set('mesa_total', $this->Mesa->calcular_total());

        $this->set(compact('mesa', 'items'));
        $this->set('mozo_json', json_encode($this->Mesa->Mozo->read(null, $mesa['Mozo']['id'])));
    }





    /**
     * Cierra la mesa, calculando el total y, si se lo indica,
     * imprime el ticket fiscal.
     * @param type $mesa_id
     * @param type $imprimir_ticket
     * @return type 
     */
    public function cerrarMesa ( $mesa_id, $imprimir_ticket = true) {
        
        $this->Mesa->id = $mesa_id;     

        $retData = $this->Mesa->cerrar_mesa();

        if( !$this->request->is('ajax') ){
            $this->redirect( $this->referer() );
        } else {
            $this->autorender = false;
            exit;            
        }
    }
    


    /**
     * Esta accion edita cualquiera de los campos de la mesa,
     * pero hay que pasar en la variabla $this->request->data el ID de
     * la mesa si o si para que funcione
     *
     * @return boolean 1 on success 0 fail
     */
    function ajax_edit() {        
        $this->autoRender = false;
        $returnFlag = 1;

        if (!empty($this->request->data)) {
            if(isset($this->request->data['Mesa']['id'])) {
                if(($this->request->data['Mesa']['id'] != '') || ($this->request->data['Mesa']['id'] != null) || ($this->request->data['Mesa']['id'] != 0)) {
                    $this->Mesa->recursive = -1;
                    $this->Mesa->id = $this->request->data['Mesa']['id'];

                    foreach($this->request->data['Mesa'] as $field=>$valor):
                        if($field == 'id') continue;// el id no lo tengo que actualizar
                        $valor = (strtolower($valor) == 'now()') ? strftime('%Y-%m-%d %H:%M:%S', time()) : $valor;
                        if (!$this->Mesa->saveField($field, $valor, $validate = true)) {
                            debug($this->Mesa->validationErrors);
                            throw new InternalErrorException("Error de Validacion al guardar");
                            
                            header("HTTP/1.0 500 Internal Server Error");
                            if($returnFlag == 1){
                                $returnFlag = 0;
                            }
                            $returnFlag--;
                        }
                    endforeach;
                }
            } else {
                throw new InternalErrorException("Id de Mesa vino vacio");
            }
        } else {
            throw new InternalErrorException("data vino vacio");
        }
        exit;
    }




    public function imprimirTicket($mesa_id) {
        $this->Mesa->printFiscalEvent($mesa_id);

        //        $this->Printer->doPrint($mesa_id);
        
        if( !$this->request->is('ajax') ){
            $this->Session->setFlash(__('Se imprimio comanda de mesa ID: '.$mesa_id), 'flash_success');
            $this->redirect($this->referer());
        } else {
            exit;
        }
    }


    
    
    public function add() {

        $insertedId = 0;
           
        if ($this->request->is('post')) {
            $this->Mesa->create();
            if ( $this->Mesa->save($this->request->data) ) {
                $insertedId = $this->Mesa->getLastInsertId();

                if ( !empty( $this->request->data['Mesa']['tipo_de_pago'])  && !empty($this->request->data['Mesa']['total']) ) {
                    $pago['Pago'] = array( 
                        'mesa_id'=>$this->Mesa->id,
                        'tipo_de_pago_id'=>$this->request->data['Mesa']['tipo_de_pago'],
                        'valor'=>$this->request->data['Mesa']['total']
                        );
                    if ( $this->Mesa->Pago->save($pago, array('fields'=>array('mesa_id','tipo_de_pago_id')))) {
                        if (!$this->request->is('ajax')) {
                            $this->Session->setFlash(__('La mesa fue guardada'));
                        }
                    }    
                }
            } else {
                if (!$this->request->is('ajax')) {
                    $this->Session->setFlash(__('La mesa no pudo ser guardada. Intente nuevamente.', 'flash_error'));
                }
            }
        }
              
        if ( !$this->request->is('ajax') ) {
            $mozos = $this->Mesa->Mozo->listFullName();
            $tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');
            $descuentos = $this->Mesa->Descuento->find('list');
            $clientes = $this->Mesa->Cliente->find('list');

            $this->set(compact('mozos', 'descuentos', 'tipo_pagos', 'clientes'));
        }
        
        $this->set('insertedId', $insertedId);
        $this->set('validationErrors', $this->Mesa->validationErrors);
        
    }



    


    public function edit($id = null) {


        if (!$id && !$this->request->is('post') ) {
            $this->Session->setFlash(__('Invalid Mesa', 'flash_error'));
            $this->redirect(array('action'=>'index'));
        }

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Mesa->save($this->request->data)) {
                $this->Session->setFlash(__('La mesa fue editada correctamente', 'flash_success'));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La mesa no pudo ser guardada. Intente nuevamente.', 'flash_error'));
            }
        }

        
        $this->request->data = $this->Mesa->find('first',array(
                'conditions'=> array(
                        'Mesa.id'=>$id),
                'contain'=>	array(
                        'Mozo',
                        'Cliente' => array(
                            'Descuento',
                            'IvaResponsabilidad' => array('TipoFactura'),
                            ) ,
                        'Pago' => array(
                            'TipoDePago'
                            ),
                        'Comanda' => array (
                            'DetalleComanda' => array(
                                'Producto',
                                'DetalleSabor' => 'Sabor'
                                )
                            )
                        )
        ));

        $items = $this->request->data['Comanda'];
        $mesa = $this->request->data;
        $mozos = $this->Mesa->Mozo->listFullName();
        
        $this->id = $id;
        $this->set('subtotal',$this->Mesa->calcular_subtotal());
        $this->set('total',$this->Mesa->calcular_total());
        $this->set('estados', $this->estados);
        $this->set(compact('mesa', 'items', 'mozos'));
    }

    public function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Mesa', true));
        }
        if ($this->Mesa->delete($id)) {
            $this->Session->setFlash(__('Mesa deleted', true));     
        } else {
        }
        if (!$this->request->is('ajax')){
            $this->redirect($this->referer());
        } else {
            die(1);
        }
    }


    public function cerradas(){
        $mesas = $this->Mesa->todasLasCerradas();
        $this->set('mesas', $mesas);
        $this->render('mesas');
    }


/*
    public function abiertas()
    {
        $options = array(
            'conditions' => array(
                "Mesa.estado_id" => MESA_ABIERTA,
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
*/


    public function reabrir($id){

        $this->Session->setFlash('Se reabrió la mesa', 'flash_success');
        $this->Mesa->reabrir($id);
        if ( !$this->request->is('ajax') ) {            
            $this->redirect($this->referer());
        } else {
            exit;
        }
    }
    
    
    public function addClienteToMesa($mesa_id, $cliente_id = 0){
        if ($cliente_id) {
            $this->Mesa->Cliente->contain(array(
                        'Descuento',
                    ));
            $this->set('cliente', $this->Mesa->Cliente->read(null, $cliente_id));
        } else {
            $this->set('cliente', array());
        }
                
                
        $this->Mesa->id = $mesa_id;
        if ($this->Mesa->saveField('cliente_id', $cliente_id) ) {
            $this->Session->setFlash('Se agregó un cliente a la mesa', true);
        }
    }
    
    
    public function cobradas(){
        $mesas = $this->Mesa->ultimasCobradas();
        $this->set('title_for_layout', 'Últimas Mesas Cobradas');
        
        $newMes = array();
        $cont = 0;
        foreach ( $mesas as $m ) {
            $newMes[$cont] = $m['Mesa'];
            $newMes[$cont]['Mozo'] = $m['Mozo'];
            $newMes[$cont]['Comanda'] = $m['Comanda'];
            $newMes[$cont]['Descuento'] = $m['Descuento'];
            $cont++;
        }
        $this->set('mesas', $newMes);
    }

}
?>