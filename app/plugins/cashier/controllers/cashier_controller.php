<?php

class CashierController extends CashierAppController {

	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer', 'RequestHandler', 'Email');
	
	
	var $layout = 'cajero';


	function reiniciar(){
		debug(exec('sudo reboot'));
		die("Aguarde, el servidor esta reiniciando. Esto puede demorar unos minutos...");
	}

        function apagar() {
            $mesa = ClassRegistry::init('Mesa');
            
            $desde =  date('Y-m-d', strtotime('-1 day') );
            $hasta =  date('Y-m-d', strtotime('-1 day'));
            
            $hora =  date('H', strtotime('now'));
            
            // solo enviar el mail si estamos en un horario comprendido entre las 23 y las 6 AM
            if ( !($hora > 13 && $hora < 23) ) {
                $fields = array(
                         'sum(m.cant_comensales) as "cant_cubiertos"' ,
                         'sum(m.subtotal) as "subtotal"', 
                         'sum(m.total) as "total"', 
                         'sum(m.total)/sum(m.cant_comensales) as "promedio_cubiertos"',
                    );

                $fields[] = 'DATE(m.created) as "fecha"';
                $group = array(
                     'DATE(m.created)',
                );

                $mesas = $this->Mesa->totalesDeMesasEntre($desde, $hasta, array(
                            'fields' => $fields,
                            'group' => $group,
                        ));

                if ( !empty($mesas) ) {
                    $fecha = date('d-m-y', strtotime('-1 day'));
                    $mensaje = 'Fecha: '. $fecha .'. ';

                    $mensaje .= "Total de Ventas: $". $mesas[0][0]['total'].'. ';                    
                    $mensaje .= "Cubiertos: ". $mesas[0][0]['cant_cubiertos'].'. ';
                    $mensaje .= "Mesas: ". $mesas[0][0]['cant_mesas'].'. ';
                    $mensaje .= "Promedio por Cubierto: ". number_format($mesas[0][0]['promedio_cubiertos'],2).'. ';
                    $mensaje .= "Sub-total de Ventas (total Neto, o sea, sin aplicar descuento): $". $mesas[0][0]['subtotal'].'. ';
                    $mensaje .= "Promedio por Cubierto NETO (si no se hubiese aplicado descuento): $". number_format( $mesas[0][0]['subtotal']/$mesas[0][0]['cant_cubiertos'],2).'. ';
                    
                    $mensaje .= '-- Chocha 012 --';
    
                    $email = Configure::read('Restaurante.name');
                    $nombreResto = Configure::read('Restaurante.mail');
                    $mail = $nombreResto.' <'. $email .'>';
                    $this->Email->from    = $mail;
                    $this->Email->to      = $mail;

                    $this->Email->subject = 'Resumen de ventas del día '.$fecha;

                    $this->Email->send($mensaje);
                }

            }
            
            debug(exec('sudo halt'));
            die("El servidor se esta apagando");
	}


        function cierre_z(){
		$this->Printer->imprimirCierreZ();

		$this->Session->setFlash("Se imprimió un Cierre Z");


		$this->redirect($this->referer());
            }
	
	
	function cierre_x(){
		$this->Printer->imprimirCierreX(); 
		
		$this->Session->setFlash("Se imprimió un reporte X");
		
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



        function activar_webcam(){
           echo "activando webcam...";
            print_r(exec("sudo sh /home/alejandro/webcamserver.sh"));
        die();
        }

	
}
