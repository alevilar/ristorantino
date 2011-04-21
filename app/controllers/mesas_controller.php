<?php
class MesasController extends AppController {

    var $name = 'Mesas';
    var $helpers = array('Html', 'Form');
    var $components = array('Printer','RequestHandler');



    function index() {
        $this->paginate['Mesa'] = array(
                'contain'	 => array('Mozo(numero)','Cliente'=>array('Descuento'))
        );


        $condiciones = array();

        if (!empty($this->passedArgs)){
            if (!empty($this->passedArgs['Mesa.numero'])){
                $this->data['Mesa']['numero'] = $this->passedArgs['Mesa.numero'];
            }
            if (!empty($this->passedArgs['Mozo.numero'])){
                $this->data['Mozo']['numero'] = $this->passedArgs['Mozo.numero'];
            }
            if (!empty($this->passedArgs['Mesa.total'])){
                $this->data['Mesa']['total'] = $this->passedArgs['Mesa.total'];
            }
            if (!empty($this->passedArgs['Mesa.created_from'])){
                $this->data['Mesa']['created_from'] = $this->passedArgs['Mesa.created_from'];
            }
            if (!empty($this->passedArgs['Mesa.created_to'])){
                $this->data['Mesa']['created_to'] = $this->passedArgs['Mesa.created_to'];
            }
            if (!empty($this->passedArgs['Mesa.time_cerro_from'])){
                $this->data['Mesa']['time_cerro_from'] = $this->passedArgs['Mesa.time_cerro_from'];
            }
            if (!empty($this->passedArgs['Mesa.time_cerro_to'])){
                $this->data['Mesa']['time_cerro_to'] = $this->passedArgs['Mesa.time_cerro_to'];
            }
            if (!empty($this->passedArgs['Mesa.time_cobro_from'])){
                $this->data['Mesa']['time_cobro_from'] = $this->passedArgs['Mesa.time_cobro_from'];
            }
            if (!empty($this->passedArgs['Mesa.time_cobro_to'])){
                $this->data['Mesa']['time_cobro_to'] = $this->passedArgs['Mesa.time_cobro_to'];
            }

        }

        if(!empty($this->data)) {

            // armo para que el paginator mantenga la busqueda
            foreach($this->data as $modelo=>$campos) {
                foreach($campos as $key=>$val) {
                    if(!is_array($val))
                        if(!empty($val)) {                    
                            $this->passedArgs["$modelo.$key"] = $val;
                        }
                }
            }


            // seteo condiciones de busqueda
            if (!empty($this->data['Mesa']['numero'])){
                $condiciones['Mesa.numero'] = $this->data['Mesa']['numero'];
            }
            if (!empty($this->data['Mozo']['numero'])){
                $condiciones['Mozo.numero'] = $this->data['Mozo']['numero'];
            }
            if (!empty($this->data['Mesa']['total'])){
                $condiciones['Mesa.total'] = $this->data['Mesa']['total'];
            }
            if (!empty($this->data['Mesa']['created_from'])){
                $condiciones['Mesa.created >'] = jsDate($this->data['Mesa']['created_from']);
            }
            if (!empty($this->data['Mesa']['created_to'])){
                $condiciones['Mesa.created <'] = jsDate($this->data['Mesa']['created_to']);
            }
            if (!empty($this->data['Mesa']['time_cerro_from'])){
                $condiciones['Mesa.time_cerro >'] = jsDate($this->data['Mesa']['time_cerro_from']);
            }
            if (!empty($this->data['Mesa']['time_cerro_to'])){
                $condiciones['Mesa.time_cerro <'] = jsDate($this->data['Mesa']['time_cerro_to']);
            }
            if (!empty($this->data['Mesa']['time_cobro_from'])){
                $condiciones['Mesa.time_cobro >'] = jsDate($this->data['Mesa']['time_cobro_from']);
            }
            if (!empty( $this->data['Mesa']['time_cobro_to'])){
                $condiciones['Mesa.time_cobro <'] = jsDate($this->data['Mesa']['time_cobro_to']);
            }
            if (!empty( $this->data['Mesa']['estado_cerrada'])){
                switch ($this->data['Mesa']['estado_cerrada']) {
                    case 'abiertas':
                        $condiciones['Mesa.time_cerro'] = DATETIME_NULL;
                        $condiciones['Mesa.time_cobro'] = DATETIME_NULL;
                        break;
                    case 'cerradas':
                        $condiciones['Mesa.created <>'] = DATETIME_NULL;
                        $condiciones['Mesa.time_cerro <>'] = DATETIME_NULL;
                        $condiciones['Mesa.time_cobro'] = DATETIME_NULL;
                        break;
                     case 'cobradas':
                        $condiciones['Mesa.created <>'] = DATETIME_NULL;
                         $condiciones['Mesa.time_cerro <>'] = DATETIME_NULL;
                        $condiciones['Mesa.time_cobro <>'] = DATETIME_NULL;
                        break;
                    default:
                        break;
                }
            }

            $this->Producto->recursive = 0;

            $this->paginate['Mesa'] = array(
                    'conditions' => $condiciones,
            );
        }
        
        //debug($this->paginate('Mesa'));
        $this->Mesa->recursive = 0;
        


        if (!empty($this->data['Mesa']['exportar_excel'])){
            $paginate['Mesa']['limit'] = null;
            $this->set('mesas', $this->Mesa->find('all',$paginate['Mesa']));
            $this->layout = 'xls';
            $this->render('xls/index');
        } else {
            $this->set('mesas', $this->paginate('Mesa'));
        }
    }


    function view($id = null) {
        $this->layout='ajax';

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

        $this->set('mesa_total', $this->Mesa->calcular_total());

        $this->set(compact('mesa', 'items'));
        $this->set('mozo_json', json_encode($this->Mesa->Mozo->read(null, $mesa['Mozo']['id'])));
    }



    function ticket_view($id = null) {

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

        $this->set('mesa_total', $this->Mesa->calcular_total());

        $this->set(compact('mesa', 'items'));
        $this->set('mozo_json', json_encode($this->Mesa->Mozo->read(null, $mesa['Mozo']['id'])));
    }



    

    private function __imprimir($mesa_id) {
        $this->Mesa->id = $mesa_id;

        $mesa = $this->Mesa->find('first',array('contain'=>array('Mozo','Cliente'=>array('Descuento'))));

        $mesa_nro = $this->Mesa->getNumero();        
        $mozo_nro = $this->Mesa->getMozoNumero();

        $cont  = 0;
        $total = 0;
        $prod = array();
        if($mesa['Mesa']['menu']>0) {
            unset($prod);
            $prod[0]['nombre'] = 'Menu';
            $total = $this->Mesa->calcular_total();
            $total_x_menu = $total/$mesa['Mesa']['menu'];
            $total_x_menu = round($total_x_menu*100) / 100;
            $prod[0]['precio'] = $total_x_menu;
            $prod[0]['cantidad'] = $mesa['Mesa']['menu'];
        } else {
            $prod = $this->Mesa->dameProductosParaTicket();
        }        

        $print_success = true;
        $imprimio_ticket = false;
        $tipoticket = 'Ticket Factura "B"';
        $porcentaje_descuento = 0;


        if(!empty($mesa['Cliente']['Descuento']['porcentaje'])) {
            $porcentaje_descuento = $mesa['Cliente']['Descuento']['porcentaje'];
        }

        $imprimio = false;
        if (Configure::read('Mesa.imprimePrimeroRemito') && !$this->Mesa->estaCerrada()){
                $print_success = $this->Printer->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$porcentaje_descuento);
                $this->log("se imprimio un ticket no fiscal desde comandera como remito para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                $tipoticket = 'Remito';
                $imprimio_ticket = true;
                $imprimio = true;
        }
        
        if(empty($mesa['Cliente']) && !$imprimio):
            $print_success = $this->Printer->imprimirTicket($prod, $mozo_nro, $mesa_nro, $porcentaje_descuento);
            $imprimio_ticket = true;

        elseif(($mesa['Cliente']['imprime_ticket'] > 0 || $mesa['Cliente']['imprime_ticket'] == '') && !$imprimio):
            switch($mesa['Cliente']['tipofactura']):
                case 'A':
                    $ivaresp = $this->Mesa->Cliente->getResponsabilidadIva($mesa['Cliente']['id']);
                    $mesa['Cliente']['responsabilidad_iva'] = $ivaresp['IvaResponsabilidad']['codigo_fiscal'];

                    $tipodoc = $this->Mesa->Cliente->getTipoDocumento($mesa['Cliente']['id']);
                    $mesa['Cliente']['tipodocumento'] = $tipodoc['TipoDocumento']['codigo_fiscal'];

                    $print_success = $this->Printer->imprimirTicketFacturaA($prod, $mesa['Cliente'], $mozo_nro, $mesa_nro, $porcentaje_descuento);
                    $tipoticket = 'Ticket Factura "A"';

                    $this->log("se imprimio una factura A para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                    $imprimio_ticket = true;
                    break;
                case '':
                case 'B':
                    $print_success = $this->Printer->imprimirTicket($prod, $mozo_nro, $mesa_nro, $porcentaje_descuento);
                    $tipoticket = 'Ticket Factura "B"';
                    $this->log("se imprimio una factura B para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                    $imprimio_ticket = true;
                    break;
                default:
                    $print_success = $this->Printer->imprimirTicketConComandera($prod, $mozo_nro, $mesa_nro,$porcentaje_descuento);
                    $this->log("se imprimio un ticket no fiscal desde comandera como remito para la mesa $mesa_nro, mozo $mozo_nro",LOG_INFO);
                    $tipoticket = 'Ticket Descuento';
                    $imprimio_ticket = true;
                endswitch;
        endif;

        $vreturn['print_success'] = false;
        $vreturn['imprimio_ticket'] = false;
        $vreturn['tipoticket'] = $tipoticket;
        $vreturn['porcentaje_descuento'] = $porcentaje_descuento;
        $vreturn['Mesa'] = $mesa;

        if($print_success):
            $vreturn['print_success'] = true;
            if($imprimio_ticket):
                $vreturn['imprimio_ticket'] = true;
            endif;
        endif;

        return $vreturn;
    }


    function cerrarMesa($mesa_id, $imprimir_ticket = true) {

        $this->Mesa->id = $mesa_id;
        $imprimio_ticket = $imprimir_ticket;
        $print_success = false;
        if ($imprimir_ticket){
            $vreturn = $this->__imprimir($mesa_id);

            $print_success   = $vreturn['print_success'];
            $imprimio_ticket = $vreturn['imprimio_ticket'];
            $tipoticket      = $vreturn['tipoticket'];
            $mesa = $vreturn['Mesa'];
            $mesa_nro = $mesa['Mesa']['numero'];
            $mozo_nro = $mesa['Mozo']['numero'];
        }

        if(empty($mesa)){
            $mesa = $this->Mesa->read();
            $mesa_nro = $mesa['Mesa']['numero'];
            $mozo_nro = $mesa['Mozo']['numero'];
        }

        $this->Mesa->cerrar_mesa();
        
        if($print_success):
            if($imprimio_ticket):
                $this->log("Se envió a imprimir el ticket de la mesa $mozo_nro, mozo $mesa_nro. Mesa ID: $mesa_id",LOG_INFO);
                $this->Session->setFlash("Se envió a imprimir el $tipoticket Mesa $mesa_nro");
            else:
                $this->Session->setFlash("Se cerró la Mesa $mesa_nro sin imprimir ticket");
            endif;
        else:
            $this->log("No se pudo imprimir el ticket de la mesa $mesa_nro, mozo $mozo_nro. Mesa ID: $mesa_id",LOG_ERROR);
            $this->Session->setFlash("No se pudo imprimir el ticket de la mesa $mesa_nro, mozo $mozo_nro.");
        endif;

        if($this->RequestHandler->isAjax()){
            $this->autoRender = false;
            $this->layout = 'ajax';
            return 1;
        } else {
            $this->redirect($this->referer());
        }
    }




    function imprimirTicket($mesa_id) {
        $vreturn = $this->__imprimir($mesa_id);
        $print_success   = $vreturn['print_success'];
        $imprimio_ticket = $vreturn['imprimio_ticket'];
        $tipoticket      = $vreturn['tipoticket'];
        $mesa = $vreturn['Mesa'];
        $mesa_nro = $mesa['Mesa']['numero'];
        $mozo_nro = $mesa['Mozo']['numero'];

        if($print_success):
            $this->Mesa->cerrar_mesa();

            if($imprimio_ticket):
                $this->log("Se envió a imprimir el ticket de la mesa $mozo_nro, mozo $mesa_nro. Mesa ID: $mesa_id",LOG_INFO);
                $this->Session->setFlash("Se envió a imprimir el $tipoticket Mesa $mesa_nro");
            else:
                $this->Session->setFlash("Se cerró la Mesa $mesa_nro sin imprimir ticket");
            endif;
        else:
            $this->log("No se pudo imprimir el ticket de la mesa $mozo_nro, mozo $mesa_nro. Mesa ID: $mesa_id",LOG_ERROR);
            $this->Session->setFlash("No se pudo imprimir el $tipoticket Mesa $mesa_nro");
        endif;

    }


    function add() {
        if (!empty($this->data)) {
            $this->Mesa->create();
            $this->data['Mesa']['created'] = $this->data['Mesa']['time_cobro'];
            if ($this->Mesa->save($this->data)) {
                $pago['Pago'] = array( 'mesa_id'=>$this->Mesa->id,
                                       'tipo_de_pago_id'=>$this->data['Mesa']['tipo_de_pago'],
                                       'valor'=>$this->data['Mesa']['total']
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
        $mozos = $this->Mesa->Mozo->find('list',array('fields'=>array('id','numero')));

        $tipo_pagos = $this->Mesa->Pago->TipoDePago->find('list');

        $this->set('tipo_pagos',$tipo_pagos);
        //$descuentos = $this->Mesa->Descuento->find('list');
        $this->set(compact('mozos', 'descuentos'));
    }



    /**
     * Esta accion edita cualquiera de los campos de la mesa,
     * pero hay que pasar en la variabla $this->data el ID de
     * la mesa si o si para que funcione
     *
     * @return boolean 1 on success 0 fail
     */
    function ajax_edit() {
        $this->autoRender = false;
        $returnFlag = 1;

        if (!empty($this->data)) {
            if(isset($this->data['Mesa']['id'])) {
                if(($this->data['Mesa']['id'] != '') || ($this->data['Mesa']['id'] != null) || ($this->data['Mesa']['id'] != 0)) {
                    $this->Mesa->recursive = -1;
                    $this->Mesa->id = $this->data['Mesa']['id'];

                    foreach($this->data['Mesa'] as $field=>$valor):
                        if($field == 'id') continue;// el id no lo tengo que actualizar
                        $valor = (strtolower($valor) == 'now()') ? strftime('%Y-%m-%d %H:%M:%S', time()) : $valor;
                        if (!$this->Mesa->saveField($field, $valor, $validate = true)) {
                            debug($this->Mesa->validationErrors);
                            if($returnFlag == 1){
                                $returnFlag = 0;
                            }
                            $returnFlag--;
                        }
                    endforeach;
                }
            }
        }
        return $returnFlag;
    }


    function edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Mesa', true));
            $this->redirect(array('action'=>'index'));
        }
        if (!empty($this->data)) {
            if ($this->Mesa->save($this->data)) {
                $this->Session->setFlash(__('La mesa fue editada correctamente', true));
                $this->redirect(array('action'=>'index'));
            } else {
                $this->Session->setFlash(__('La mesa no pudo ser guardada. Intente nuevamente.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Mesa->find('first',array(
                    'conditions'=> array(
                            'Mesa.id'=>$id),
                    'contain'=>	array(
                            'Mozo',
                            'Cliente'=>'Descuento',
                            'Comanda'=>array('DetalleComanda'=>array('Producto','DetalleSabor'=>'Sabor')))
            ));
        }

        //$this->Mesa->id = $id;
        //$items = $this->Mesa->listado_de_productos();
        $items = $this->data['Comanda'];

        $mesa = $this->data;
        $this->set(compact('mesa', 'items'));

        $this->set('subtotal',$this->Mesa->calcular_total());


        $mozos = $this->Mesa->Mozo->find('list',array('fields'=>array('id','numero')));
        $this->set(compact('mozos'));
    }

    function delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Mesa', true));
            $this->redirect($this->referer());
        }
        if ($this->Mesa->del($id)) {
            $this->Session->setFlash(__('Mesa deleted', true));
            $this->redirect($this->referer());
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
            'contain' => array('Mozo',
                'Cliente' => 'Descuento',
                'Comanda')
        );

        $mesas = $this->Mesa->find('all', $options);
        $this->set('mesas', $mesas);
        $this->render('mesas');
    }


    function reabrir($id){
        $this->Session->setFlash('Se reabrió la mesa', true);
        $this->Mesa->reabrir($id);
        $this->redirect($this->referer());
    }

}
?>