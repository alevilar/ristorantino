<?php

App::uses('MesaAppController', 'Mesa.Controller');


class MesasController extends MesaAppController {

    var $name = 'Mesas';

    public $components = array(        
        'Search.Prg',
        'Paginator', 
        
        );

    public $paginate = array(
        'order' => array('Mesa.created' => 'asc'),
        // 'paramType' => 'querystring',
    );
    
    var $estados = array(
        1 => "Abierta",
        2 => "Cerrada",
        3 => "Cobrada",
        );


    
    function index() {
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

    }


    function view($id = null) {

        if (!$id) {
            $this->Session->setFlash(__('Invalid Mesa.', true));
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
     * Imprime un ticket fiscal
     * @param type $mesa_id 
     */
    private function __imprimir($mesa_id) {
        $this->Printer->doPrint($mesa_id);
    }


    /**
     * Cierra la mesa, calculando el total y, si se lo indica,
     * imprime el ticket fiscal.
     * @param type $mesa_id
     * @param type $imprimir_ticket
     * @return type 
     */
    function cerrarMesa($mesa_id, $imprimir_ticket = true) {
        
        $this->Mesa->id = $mesa_id;

        if ($imprimir_ticket){
            $this->Printer->doPrint($mesa_id);
        }

        $retData = $this->Mesa->cerrar_mesa();

        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            $this->layout = 'ajax';
            debug($retData);
            return 1;
        } else {
            $this->redirect( $this->referer() );
        }
    }




    function imprimirTicket($mesa_id) {
        $this->Printer->doPrint($mesa_id);
        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            $this->layout = 'ajax';
            return 1;
        } else {
            if(Configure::read('debug') == 0){
                $this->redirect($this->referer());
            } else {
                $this->flash('Se imprimio comanda de mesa ID: '.$mesa_id.' (click para reimprimir)', $this->action.'/'.$mesa_id);
            }
        }
    }


    function abrirMesa(){
        
        $insertedId = 0;
        if (!empty($this->request->data['Mesa'])) {
            $this->request->data['Mesa']['estado_id'] = MESA_ABIERTA;
//            unset( $this->request->data['Mesa']['created'] );
            if ( $this->Mesa->save($this->request->data) ){
                $insertedId = $this->Mesa->getLastInsertId();
            }
        }
        $this->set('insertedId', $insertedId);
        $this->set('mesa', $this->Mesa->read(null) );
        $this->set('validationErrors', $this->Mesa->validationErrors);
    }
    
    function add() {
        if (!empty($this->request->data)) {
            $this->Mesa->create();
            $this->request->data['Mesa']['created'] = $this->request->data['Mesa']['time_cobro'];
            if ($this->Mesa->save($this->request->data)) {
                $pago['Pago'] = array( 'mesa_id'=>$this->Mesa->id,
                                       'tipo_de_pago_id'=>$this->request->data['Mesa']['tipo_de_pago'],
                                       'valor'=>$this->request->data['Mesa']['total']
                    );
                if ($this->Mesa->Pago->save($pago, array('fields'=>array('mesa_id','tipo_de_pago_id')))) {
                    debug($this->Mesa->Pago->id);
                    $this->Session->setFlash(__('La mesa fue guardada', true));
                   // $this->redirect(array('action'=>'index'));
                }
            } else {
                $this->Session->setFlash(__('La mesa no pudo ser guardada. Intente nuevamente.', true));
            }
        }
        
        $options['joins'] = array(
            array('table' => 'users',
            'alias' => 'User',
            'type' => 'inner',
            'conditions' => array(
            'user.role = mozo'
                )
            ),
        );
              
$mozosAll = $this->Mesa->Mozo->find('all', array(
    'fields'=>array('Mozo.id','Mozo.numero','User.username','User.nombre','User.apellido'),
    'recursive' => 0,
    'conditions' => array(
        'Mozo.activo' => 1
    )
    ));

$mozos = array();
foreach ($mozosAll as $mz) {
    $mozos[$mz['Mozo']['id']] = "(".$mz['Mozo']['numero'] . ") " .$mz['User']['nombre']. " ". $mz['User']['apellido'];
}
$tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');

        $this->set('tipo_pagos',$tipo_pagos);
        //$descuentos = $this->Mesa->Descuento->find('list');
        $this->set(compact('mozos', 'descuentos'));
    }



    


    function edit($id = null) {
                
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash(__('Invalid Mesa', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->request->data)) {
            if ($this->Mesa->save($this->request->data)) {
                $this->Session->setFlash(__('La mesa fue editada correctamente', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La mesa no pudo ser guardada. Intente nuevamente.', true));
            }
        }
        if (empty($this->request->data)) {
            $this->request->data = $this->Mesa->find('first',array(
                    'conditions'=> array(
                            'Mesa.id'=>$id),
                    'contain'=>	array(
                            'Mozo',
                            'Cliente' => 'Descuento',
                            'Comanda' => array (
                                'DetalleComanda' => array(
                                    'Producto',
                                    'DetalleSabor' => 'Sabor'
                                    )
                                )
                            )
            ));
        }

        $items = $this->request->data['Comanda'];
        $mesa = $this->request->data;
        $mozos = $this->Mesa->Mozo->find('all',array(
            'recursive' => -1,
            'conditions' => array('Mozo.activo' => 1),
            ));
        $mooo = array();
        foreach ( $mozos as $mm) {
            $mooo[$mm['Mozo']['id']] = $mm['Mozo']['numero'] ."- ";
            if (!empty( $mm['User'] )) {
                $mooo[$mm['Mozo']['id']] .= " " . $mm['User']['nombre'] . " " . $mm['User']['apellido'];
            }
        }
        
        $this->id = $id;
        $this->set('subtotal',$this->Mesa->calcular_subtotal());
        $this->set('total',$this->Mesa->calcular_total());
        $this->set('estados', $this->estados);
        $this->set('mozos', $mooo);
        $this->set(compact('mesa', 'items'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Mesa', true));
        }
        if ($this->Mesa->del($id)) {
            $this->Session->setFlash(__('Mesa deleted', true));     
        } else {
        }
        if (!$this->RequestHandler->isAjax()){
            $this->redirect($this->referer());
        } else {
            die(1);
        }
    }


    function cerradas(){
        $mesas = $this->Mesa->todasLasCerradas();
        $this->set('mesas', $mesas);
        $this->render('mesas');
    }


    function abiertas()
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



    function reabrir($id){
        $this->Session->setFlash('Se reabrió la mesa', true);
        $this->Mesa->reabrir($id);
        if ($this->RequestHandler->isAjax()) {
            die("reabrio la mesa ID: $id");
        } else{
            $this->redirect($this->referer());
        }
    }
    
    
    function addClienteToMesa($mesa_id, $cliente_id = 0){
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
    
    
    function cobradas(){
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