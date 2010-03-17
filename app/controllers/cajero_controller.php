<?php

class CajeroController extends AppController {

	var $name = 'Cajero';
	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer');
	
	
	var $layout = 'cajero';


	
	function reiniciar(){
		debug(exec('sudo reboot'));
		die("aguarde que el server esta reiniciandose. Esto puede demorar unos minutos....");
	}
	
	
	function cierre_x(){		
		$this->Printer->imprimirCierreX(); 
		
		$this->Session->setFlash("Se imprimió un reporte X");
		
		$this->redirect('/cajero/cobrar');
	}
	
	
	function cierre_Z(){		
		$this->Printer->imprimirCierreZ(); 
		
		$this->Session->setFlash("Se imprimió un Cierre Z");
		
		$this->redirect('/cajero/cobrar');
	}
	
	function vaciar_cola_impresion_fiscal(){		
		$this->Printer->eliminarComandosEncolados();
		$this->Session->setFlash("Se eliminaron todos los tickets que estaban por
imprimirse");
		
		exec("sudo /etc/init.d/spooler_srv stop");
		exec("sudo /etc/init.d/spooler_srv start");
		exec("cd /");	

		$this->redirect('/cajero/cobrar');
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
		//die("que paso");
		Configure::write('debug', 1);
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

	
}