<?php

class AccountController extends AccountAppController {

	var $helpers = array('Html', 'Form');
	var $uses = array('Mozo','Mesa');
	var $components = array( 'Printer', 'RequestHandler');
	
	
	//var $layout = 'cajero';
	
	function index(){
		
	}

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
