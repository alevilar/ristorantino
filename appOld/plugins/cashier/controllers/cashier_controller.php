<?php

class CashierController extends CashierAppController {

	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer', 'RequestHandler', 'Email');
	
	
	var $layout = 'cajero';

        function enviar_informe(){
            $desde =  date('Y-m-d', strtotime('-1 day') );
            $mesas = $this->Mesa->totalesDeMesasEntre($desde, $desde);

            if ( !empty($mesas) ) {
                $fecha = date('d-m-y', strtotime($desde));
                $mensaje = 'Fecha: '. $fecha .'. ';

                $mensaje .= "Total de Ventas: $". $mesas[0][0]['total'].'. ';                    
                $mensaje .= "Cubiertos: ". $mesas[0][0]['cant_cubiertos'].'. ';
                $mensaje .= "Mesas: ". $mesas[0][0]['cant_mesas'].'. ';
                $mensaje .= "Promedio por Cubierto: ". number_format($mesas[0][0]['promedio_cubiertos'],2).'. ';

                $mensaje .= '-- Chocha 012 --';

                $email = Configure::read('Restaurante.mail');
                $nombreResto = Configure::read('Restaurante.name');
                $mail = $nombreResto.' <'. $email .'>';
                $this->Email->from    = $mail;
                $this->Email->to      = $mail;

                $this->Email->subject = 'Resumen de ventas del día '.$fecha;

                $this->Email->send($mensaje);
                $this->Session->setFlash('Informe enviado a "'.$nombreResto.' <'. $email .'>"');
            } else {
                $this->Session->setFlash('No hubo ventas, por lo tanto no se envía el informe.');
            }
            
            $this->redirect( $this->referer() );
        }


        function cierre_z(){
		$this->Printer->imprimirCierreZ();

		$this->Session->setFlash("Se imprimió un Cierre Z");

		if ( $this->RequestHandles->isAjax() ) {
                    return 1;
                }
		$this->redirect($this->referer());
            }
	
	
	function cierre_x(){
		$this->Printer->imprimirCierreX(); 
		
		$this->Session->setFlash("Se imprimió un reporte X");
		
                if ( $this->RequestHandles->isAjax() ) {
                    return 1;
                }
		$this->redirect($this->referer());
	}

        function nota_credito(){
		if (!empty($this->data)) {
                    $cliente = array();
                    if(!empty($this->data['Cliente']) && $this->data['Cajero']['tipo'] == 'A'){
                        $cliente['razonsocial'] = $this->data['Cliente']['razonsocial'];
                        $cliente['numerodoc'] = $this->data['Cliente']['numerodoc'];
                        $cliente['respo_iva'] = $this->data['Cliente']['respo_iva'];
                        $cliente['tipodoc'] = $this->data['Cliente']['tipodoc'];
                    }
                    
                    $this->Printer->imprimirNotaDeCredito(
                            $this->data['Cajero']['numero_ticket'],
                            $this->data['Cajero']['importe'],
                            $this->data['Cajero']['tipo'],
                            $this->data['Cajero']['descripcion'],
                            $cliente
                            );
                    $this->Session->setFlash("Se imprimió una nota de crédito");
                }
	}

	
	
	
	function vaciar_cola_impresion_fiscal($devName = null){
		$this->Printer->eliminarComandosEncolados();
		$this->Session->setFlash("Se eliminaron todos los tickets que estaban por
imprimirse");

                // reinicia el servidor de impresion
		comandosDeReinicializacionServidorImpresion($devName);

		$this->redirect($this->referer());
	}

        function listar_dispositivos(){
            $this->layout = false;
            echo "<br>";
            echo exec('ls /dev/tty*');
            die;
        }
	
	
	
	function print_dnf(){		
		$this->Printer->printDNF();
		
		$this->Session->setFlash("Se imprimió documento no fiscal");
		
		die("se imprimio un DNF");
	}
	
	
	
	function cobrar()
	{		
		$this->set('tipo_de_pagos', $this->Mesa->Pago->TipoDePago->find('list'));	
	}
	
	
	function ajax_mesas_x_cobrar(){
		$this->RequestHandler->setContent('json', 'text/x-json');

		$this->layout = 'default';
		$mesas = $this->Mesa->todasLasCerradas();
	
		$this->set('mesas_cerradas', $mesas);
	}
	
	
	function mesas_abiertas(){
		$conditions = array("Mesa.time_cobro" => "0000-00-00 00:00:00",
                                    "Mesa.time_cerro" => "0000-00-00 00:00:00");
		
		$this->paginate['Mesa'] = array(
                        'limit' => 28,
                        'conditions'=>$conditions,
                        'order'=>'Mesa.created DESC',
                        'contain'=>	array(	'Mozo',
                        'Cliente'=>'Descuento',
                        'Comanda')				
		);
		
		 $mesas = $this->paginate('Mesa');
 		 $this->set('mesas_abiertas',$mesas);
	}



        function ultimas_cobradas(){
            $conditions = array("Mesa.time_cobro >" => "0000-00-00 00:00:00",
                                    "Mesa.time_cerro >" => "0000-00-00 00:00:00");

		$this->paginate['Mesa'] = array(
                        'limit' => 28,
                        'conditions'=>$conditions,
                        'order'=>'Mesa.time_cobro DESC',
                        'contain'=> array(
                            'Mozo',
                            'Cliente'=>'Descuento',
                            'Comanda'),
		);

		 $mesas = $this->paginate('Mesa');
 		 $this->set('mesas',$mesas);
        }

	
}
