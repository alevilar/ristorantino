<?php

class CashierController extends AditionAppController {

	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer', 'RequestHandler', 'Email');
	
	
//	var $layout = 'cajero';


	
	function reiniciar(){
		debug(exec('sudo reboot'));
		die("Aguarde, el servidor esta reiniciando. Esto puede demorar unos minutos...");
	}

        function apagar(){
		debug(exec('sudo halt'));
		die("El servidor se esta apagando");
	}


        function cierre_z(){
		$this->Printer->imprimirCierreZ();

                if (! $this->request->is('ajax')) {
                    $this->Session->setFlash("Se imprimió un Cierre Z");
                    $this->redirect($this->referer());
                }
                return 1;
            }
	
	
	function cierre_x(){
		$this->Printer->imprimirCierreX(); 
		
                if (! $this->request->is('ajax')) {
                    $this->Session->setFlash("Se imprimió un reporte X");
                   // $this->redirect($this->referer());
                }
//                return 1;
	}

        function nota_credito(){
		if (!empty($this->request->data)) {
                    $cliente = array();
                    if(!empty($this->request->data['Cliente']) && $this->request->data['Cajero']['tipo'] == 'A'){
                        $cliente['razonsocial'] = $this->request->data['Cliente']['razonsocial'];
                        $cliente['numerodoc'] = $this->request->data['Cliente']['numerodoc'];
                        $cliente['respo_iva'] = $this->request->data['Cliente']['respo_iva'];
                        $cliente['tipodoc'] = $this->request->data['Cliente']['tipodoc'];
                    }
                    
                    $this->Printer->imprimirNotaDeCredito(
                            $this->request->data['Cajero']['numero_ticket'],
                            $this->request->data['Cajero']['importe'],
                            $this->request->data['Cajero']['tipo'],
                            $this->request->data['Cajero']['descripcion'],
                            $cliente
                            );
                    $this->Session->setFlash("Se imprimió una nota de crédito");
                }
	}

	
	
	
	function vaciar_cola_impresion_fiscal($devName = null){
            $this->autoRender = false;
//		$this->Printer->eliminarComandosEncolados();

                // reinicia el servidor de impresion
		comandosDeReinicializacionServidorImpresion($devName);
                return 1;die;
	}

        function listar_dispositivos(){            
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
