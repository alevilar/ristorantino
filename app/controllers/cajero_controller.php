<?php

class CajeroController extends AppController {

	var $name = 'Cajero';
	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer');
	
	
	var $layout = 'cajero';


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
		$this->Session->setFlash("Se eliminaron todos los tickets que esaban por imprimirse");
		
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
		Configure::write('debug', 0);
		$this->RequestHandler->setContent('json', 'text/x-json');

		$mesas = $this->Mesa->todasLasCerradas();
	
		$this->set('mesas_cerradas', $mesas);
	}
	
	
	function mesas_abiertas(){
	//	$conditions = array("Mesa.time_cobro = '0000-00-00 00:00:00'",
	//						"Mesa.time_cerro = '0000-00-00 00:00:00'");
		
		$conditions = array("Mesa.time_cobro" => "0000-00-00 00:00:00",
							"Mesa.time_cerro" => "0000-00-00 00:00:00");
		
		$this->paginate = array('limit' => 28,'conditions'=>$conditions, 'order'=>'Mesa.created DESC');
		 $mesas = $this->paginate('Mesa');
//	debug($mesas);
		 for ($i = 0; $i<count($mesas); $i++):
		 	$this->Mesa->id = $mesas[$i]['Mesa']['id'];
		 	$mesas[$i]['subtotal'] = $this->Mesa->calcular_total();
		 endfor;
		$this->set('mesas_abiertas',$mesas);
	}

	
}