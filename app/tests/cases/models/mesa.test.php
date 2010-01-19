<?php


App::import('Model','Mesa');


class TestMesa extends Mesa{
	
}




class MesaTestCase extends CakeTestCase {
	
	function setup(){
		$this->Mesa = New TestMesa();
	}
	
	function testGetProductosParaImprimirTicket(){
		$this->assertEqual(count($this->Mesa->find('all')),1);
		
	}
	

}

	?>