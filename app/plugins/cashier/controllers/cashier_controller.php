<?php

class CashierController extends CashierAppController {

	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer', 'RequestHandler');
	
	
	var $layout = 'cajero';


	
	function reiniciar(){
		debug(exec('sudo reboot'));
		die("aguarde que el server esta reiniciandose. Esto puede demorar unos minutos....");
	}

        function apagar(){
		debug(exec('sudo halt'));
		die("El server se esta apagando");
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
                    
                    $this->Printer->imprimirNotaDeCredito(
                            $this->data['Cajero']['numero_ticket'],
                            $this->data['Cajero']['importe'],
                            $this->data['Cajero']['tipo']
                            );
                    $this->Session->setFlash("Se imprimió una nota de crédito");
                }
	}

	
	
	
	function vaciar_cola_impresion_fiscal(){		
		$this->Printer->eliminarComandosEncolados();
		$this->Session->setFlash("Se eliminaron todos los tickets que estaban por
imprimirse");

                // reinicia el servidor de impresion
		comandosDeReinicializacionServidorImpresion();

		$this->redirect($this->referer());
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
	//	$conditions = array("Mesa.time_cobro = '0000-00-00 00:00:00'",
	//						"Mesa.time_cerro = '0000-00-00 00:00:00'");
		
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
		 /*
		 for ($i = 0; $i<count($mesas); $i++):
		 	$this->Mesa->id = $mesas[$i]['Mesa']['id'];
		 	$mesas[$i]['subtotal'] = $this->Mesa->calcular_total();
		 endfor;
		 */
		$this->set('mesas_abiertas',$mesas);
	}



        function activar_webcam(){
           echo "activando webcam...";
            print_r(exec("sudo sh /home/alejandro/webcamserver.sh"));
        die();
        }

	
}