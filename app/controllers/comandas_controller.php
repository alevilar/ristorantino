<?php
class ComandasController extends AppController {

	var $name = 'Comandas';
	var $components = array( 'Printer');
	
	
	
	function add(){
		$this->autoRender = false;
		//Configure::write('debug',0);
		
		if (isset($this->data)):
				$this->Comanda->create();
				if ($this->Comanda->save($this->data)) {					
					$j = 1;
					?><script type="text/javascript">
						<!--
						mensajero.show("comanda enviada");
						//-->
						</script>
					<?php 			
				} else {
					$this->Session->setFlash(__('The Comanda could not be saved. Please, try again.', true));
				}
		endif;
	}
	
	
	function index(){
		$this->set('comandas',$comandas = $this->Comanda->dame_las_comandas_abiertas());
		
	}
	
	/**
	 * REimprime comandas
	 * @param integer $id ID de la comanda
	 * @return envia a imprimir
	 */
	function imprimir($id){
		$this->Printer->imprimirComanda($id);
		$this->redirect('/comandas/index');
	}
}
?>