<?php

class CajeroController extends AppController {

	var $name = 'Cajero';
	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	
	var $layout = 'cajero';

		
	
	function cobrar(){	
		
		$this->set('tipo_de_pagos', $this->Mesa->Pago->TipoDePago->find('list'));
		
	}
	
	
	function mesas_x_cobrar(){
		$conditions = array("time_cobro" => "0000-00-00 00:00:00",'time_cerro <>'=>"0000-00-00 00:00:00");
		$this->paginate = array('limit' => 28,'conditions'=>$conditions, 'order'=>'time_cerro');
		$this->set('mesas_cerradas', $this->paginate('Mesa'));
	}
	
	
	function mesas_abiertas(){
		$conditions = array("time_cobro" => "0000-00-00 00:00:00",'time_cerro '=>"0000-00-00 00:00:00");
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