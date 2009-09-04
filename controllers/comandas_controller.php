<?php
class ComandasController extends AppController {

	var $name = 'Comandas';
	
	
	
	
	function add(){
		$this->autoRender = false;
		//Configure::write('debug',0);
		
		if (isset($this->data)):
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
}
?>