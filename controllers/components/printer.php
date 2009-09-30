<?php



class PrinterComponent extends Object {
	
	var $comanderas = array();
	
	var $impresoraFiscal = null;
	
	
	
	function startup(&$controller) {
          
		$comandera =& ClassRegistry::init('Comandera'); 
		$comanderas = $comandera->find('all');
		// creo las carpetas temporales
		foreach($comanderas as $c){
			$this->comanderas[$c['Comandera']['id']] = $c;
			if(!is_dir($c['Comandera']['path'])){
				mkdir($c['Comandera']['path'],0777,true);
			}
		}
		
		$fiscal =& ClassRegistry::init('Impfiscal'); 
		$this->impresoraFiscal = $fiscal->find('first');
		
	}
	
	
	
	function imprimirComanda($comanda_id){
		
		$Comanda =& ClassRegistry::init('Comanda'); 		
		
		$productos_x_comanda = array();
		foreach ($this->comanderas as $comandera){
			$productos_x_comanda[$comandera['Comandera']['id']] = $Comanda->listado_de_productos_con_sabores($comanda_id);
		}
		
		// genero el array lindo paraimprimir por cada comanda
		while(list($comandera_id, $productos) = each($productos_x_comanda))
		{
			foreach($productos as $detalle){
				$prod_cant = $detalle['DetalleComanda']['cant'];
				$prod_name = $detalle['Producto']['name'];
				$prod_sabor = '';
				$primero = true;
				foreach ( $detalle['DetalleSabor'] as $sabor){
					if(!$primero){
						$prod_sabor .= ', ' ;
					}
					else{
						$prod_sabor .= 'de: [' ;
						$primero = false;
					}
					$prod_sabor .= $sabor['Sabor']['name'];
				}
				$prod_sabor .= (count($detalle['DetalleSabor']) == 0)?'':']';
				
				$prod_a_imprimir[] =	"$prod_cant) $prod_name $prod_sabor";
			}
			
			// imprimo el array de esta primer comanda
			try {
				$archivo_comanda = fopen($this->comanderas[$comandera_id]['Comandera']['path']."/printer_".$this->comanderas[$comandera_id]['Comandera']['id']."_comanda_$comanda_id.txt", "r+");
				foreach($prod_a_imprimir as $item){
					 fwrite($archivo_comanda,$item);
					 fwrite($archivo_comanda,"\n");
				}
			} catch (Exception $e) {
			}
			
		}
		
		
		
	}
	
	
	function imprimirTicket($mesa_id){
		
		$Mesa =& ClassRegistry::init('Mesa'); 		
		
		$productos_x_comanda = array();
		foreach ($this->comanderas as $comandera){
			$productos_x_comanda[$comandera['Comandera']['id']] = $Mesa->DetalleComanda->find('all', array('conditions'=>array(
																			'Producto.comandera_id'=>$comandera['Comandera']['id'],
																			'Comanda.id'=>$comanda_id,
			)));
		}
		
		
		
		
	}
}

?>