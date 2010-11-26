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
              exit;
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

                // reinicia el servidor de impresion
		comandosDeReinicializacionServidorImpresion();

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
	
	
	
	



        function activar_webcam(){
           echo "activando webcam...";
            print_r(exec("sudo sh /home/alejandro/webcamserver.sh"));
        die();
        }

	
}