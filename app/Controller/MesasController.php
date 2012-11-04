<?php
class MesasController extends AppController {

    public $helpers = array('Html', 'Form');
    public $components = array('Printer', 'Search.Prg');
    
   
    /* @var $Printer PrinterComponent */
    public $Printer;
    
    public $paginate = array(
        'paramType' => 'querystring'
    );
    
    
    public function index( $estado = null ) {
        $this->Prg->commonProcess();
        $this->paginate['conditions'] = $this->Mesa->parseCriteria($this->passedArgs);
        $this->request->data['Mesa'] = $this->passedArgs;

        if ( !empty($estado) ){
                switch ( $estado ) {
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
       
        $this->set('mesas', $this->paginate());
        $this->set('estados', $this->Mesa->estados);
        
    }


    public function view($id = null) {

        if (!$id) {
            $this->Session->setFlash(__('Invalid Mesa.', true));
            $this->redirect(array('action'=>'index'));
        }

        $this->Mesa->id = $id;
        $items = $this->Mesa->listado_de_productos();


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
        $this->set('mesa_total', $this->Mesa->getTotal());

        $this->set(compact('mesa', 'items'));
        $this->set('mozo_json', json_encode($this->Mesa->Mozo->read(null, $mesa['Mozo']['id'])));
    }



    public function ticket_view($id = null) {

        if (!$id) {
            $this->Session->setFlash(__('Invalid Mesa.', true));
            $this->redirect(array('action'=>'index'));
        }

        $this->Mesa->id = $id;
        $items = $this->Mesa->dameProductosParaTicket();


        //$mesa = $this->Mesa->read(null, $id);
        $mesa = $this->Mesa->find('first',array(
                'conditions'=>array('Mesa.id'=>$id),
                'contain'=>array(
                        'Mozo(id,numero)',
                        'Cliente(id,nombre,imprime_ticket,tipofactura)',
                        'Comanda(id,prioridad,observacion)')
        ));

        $cont = 0;
        
        $mesa['Producto'] = $items;

        $this->set('mesa_total', $this->Mesa->getTotal());

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
    public function cerrarMesa($mesa_id, $imprimir_ticket = true) {
        
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




    public function imprimirTicket($mesa_id) {
        
        $fiscalData = $this->Mesa->getDataParaFiscal($mesa_id);
        
        
            // imprimir pre-ticket al cerrar la mesa. 
            // Solo si esta configurado asi y la mesa esta cerrada por primera vez (o que aun este abierta)
            if (Configure::read('Mesa.imprimePrimeroRemito') && $this->Model->Mesa->estaAbierta()){
                    return $this->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$this->porcentaje_descuento);
            } else{
                if ( isset ( $this->Mesa['Cliente']['imprime_ticket']) && $this->Mesa['Cliente']['imprime_ticket'] != 0) {
                    switch($this->Mesa['Cliente']['tipofactura']){
                        case 'A':
                            $ivaresp = $this->Model->Mesa->Cliente->getResponsabilidadIva($this->Mesa['Cliente']['id']);
                            $this->Mesa['Cliente']['responsabilidad_iva'] = $ivaresp['IvaResponsabilidad']['codigo_fiscal'];

                            $tipodoc = $this->Model->Mesa->Cliente->getTipoDocumento($this->Mesa['Cliente']['id']);
                            $this->Mesa['Cliente']['tipodocumento'] = $tipodoc['TipoDocumento']['codigo_fiscal'];

                             $this->imprimirTicketFacturaA($prod, $this->Mesa['Cliente'], $mozo_nro, $mesa_nro, $this->importe_descuento);
                        default:
                            $this->imprimirTicket($prod, $mozo_nro, $mesa_nro, $this->importe_descuento);
                            break;
                    };   
                }
            }            
            
        
        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            $this->layout = 'ajax';
            return 1;
        } else {
                $this->flash('Se imprimio comanda de mesa ID: '.$mesa_id.' (click para reimprimir)', $this->action.'/'.$mesa_id);
                $this->redirect($this->referer());
        }
    }


    public function abrirMesa(){
        
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
    
    public function add() {
        if ($this->request->is('post')) {
                $this->Mesa->create();
                if ($this->Mesa->save($this->request->data)) {
                        $this->Session->setFlash(__('The mesa has been saved'));
                        if ( $this->request->is('ajax') ) {
                            $this->redirect(array('action' => 'index'));
                        } else {
                            return 1;
                        }
                } else {
                        $this->Session->setFlash(__('The mesa could not be saved. Please, try again.'));
                }
        }
                
        $mozos = $this->Mesa->Mozo->find('list',array('fields'=>array('id','numero_y_nombre')));
        $tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');
        $descuentos = $this->Mesa->Descuento->find('list');        
        $estados = $this->Mesa->estados;
        $this->set(compact('mozos', 'descuentos', 'tipo_pagos', 'estados'));
    }



    /**
     * Esta accion edita cualquiera de los campos de la mesa,
     * pero hay que pasar en la variabla $this->request->data el ID de
     * la mesa si o si para que funcione
     *
     * @return boolean 1 on success 0 fail
     */
    public function ajax_edit() {        
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
                            header("HTTP/1.0 500 Internal Server Error");
                            if($returnFlag == 1){
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
  


    public function edit($id = null) {
        
        $this->Mesa->id = $id;
        if (!$this->Mesa->exists()) {
                throw new NotFoundException(__('Invalid mesa'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
                if ($this->Mesa->save($this->request->data)) {
                        $this->Session->setFlash(__('The mozo has been saved'));
                        if ( !$this->request->is('ajax') ) {
                            $this->redirect(array('action' => 'index'));
                        }
                } else {
                        $this->Session->setFlash(__('The mozo could not be saved. Please, try again.'));
                }
        }
               
        $mesa = $this->request->data = $this->Mesa->find('first',array(
                    'conditions'=> array(
                            'Mesa.id'=>$id),
                    'contain'=>	array(
                            'Mozo',
                            'Cliente'=>'Descuento',
                            'Comanda'=>array(
                                'DetalleComanda' => array(
                                    'Producto',
                                    'DetalleSabor'=>'Sabor'
                                    )
                                )
                        )
        ));

        $items = $this->request->data['Comanda'];
        $mozos = $this->Mesa->Mozo->find('list',array(
            'fields' => array('id', 'numero_y_nombre'),
            'conditions' => array('Mozo.activo' => 1),
            ));        
        
        $this->id = $id;
        $this->set('subtotal',$this->Mesa->getSubtotal());
        $this->set('total',$this->Mesa->getTotal());
        $this->set('estados', $this->Mesa->estados);
        $this->set(compact('mesa', 'items', 'mozos'));
        $this->set('title_for_layout', 'Editando la Mesa '.$mesa['Mesa']['numero'] );
    }
    
    
    
/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		$this->Mesa->id = $id;
		if (!$this->Mesa->exists()) {
			throw new NotFoundException(__('Invalid mesa'));
		}
		if ($this->Mesa->delete()) {
			$this->Session->setFlash(__('Mesa deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Mesa was not deleted'));
		
                if (!$this->request->is('ajax')){
                    $this->redirect($this->referer());
                } else {
                    return ;
                }
    }



    public function cerradas(){
        $mesas = $this->Mesa->todasLasCerradas();
        $this->set('mesas', $mesas);
        $this->render('mesas');
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



    public function reabrir($id){
        
        if ( $this->Mesa->reabrir($id) ) {
            $this->Session->setFlash('Se reabrió la mesa', true);
        } else {
            $this->Session->setFlash('Error al reabrir la mesa', true);
        }
        if (!$this->request->is('ajax')) {
            $this->redirect($this->referer());
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

}
?>