<?php


App::import('Model','Mesa');



class MesaTestCase extends CakeTestCase {
	var $autoFixtures = false;
        var $fixtures = array('app.mesa','app.pago');

         function start() {
            parent::start();
            $this->Mesa =& ClassRegistry::init('Mesa');
            
        }
	
	function testGetProductosParaImprimirTicket(){
		$this->assertEqual(count($this->Mesa->find('all')),1);
		
	}


        function testGuardarMesaConTipoDePago(){
            $this->loadFixtures();
        }
	

}

	?>