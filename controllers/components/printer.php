<?php



class PrinterComponent extends Object {
	
	var $comanderas = array();
	
	var $impresoraFiscal = null;
	
	
	
	function startup(&$controller) {
          
		$comandera =& ClassRegistry::init('Comandera');
		$comandera->recursive = -1; 
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
	
	
	/**
	 * Imprime una Comanda para la cocina
	 *
	 */
	function imprimirComanda($comanda_id){
		
		$Comanda =& ClassRegistry::init('Comanda'); 		
		
		$productos_x_comanda = array();
		// se supone que en una comanda yo no voy a tener productos que se impriman en comanderas distitas 
		// (esto es separado desde el mismo controlador y se manda aimprimir a comandas diferentes)
		// pero , por las dudas que ésto suceda, cuando yo listo los productos de una comanda, me los separa para ser impreso en Comanderas distintas
		// Entonces, por lo genral (SIEMPRE) se imprimiria x 1 sola Comandera en este método del Componente
		
		//comanderas_involucradas es un array de IDś dlas comaderas involucradas en esta comanda
		$comanderas_involucradas =  $Comanda->comanderas_involucradas($comanda_id);
		
		$productos = $Comanda->listado_de_productos_con_sabores($comanda_id); 
		
		
		// genero el array lindo paraimprimir por cada comanda
		// o sea, genero un renglón de la comanda
		// por ejmeplo me queraria algo asi:
		// "1) Milanesa de pollo\n"
		foreach($comanderas_involucradas as $comandera_id):
			
			foreach($productos as $detalle):
				// solo imprimir el producto que se imprime con esta comandera
				if($detalle['Producto']['comandera_id']==$comandera_id){
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
				
			endforeach;
			
			// imprimo el array de esta primer comanda
			try {
				//path y nombre del txt que voy a guardar en elpath temporal de la impresora par luego mandarlo a imprimir
				$arch_name = $this->comanderas[$comandera_id]['Comandera']['path']."/printer_".$comandera_id."_comanda_".$comanda_id.".txt";
						
				if(!file_exists($arch_name)){
					// si el archivo no existe lo creo
					$archivo_comanda = fopen($arch_name, "x+");
					
					// IMPRIMO EL HEADER
					$title = ($productos[0]['Comanda']['prioridad'])?'COMANDA PRIORIDAD':'Comanda';
					$header = " - $title # $comanda_id -";				
					fwrite($archivo_comanda,$header);
					fwrite($archivo_comanda,"\n\n");
					
					foreach($prod_a_imprimir as $item){
						 if(!fwrite($archivo_comanda,$item)) throw new Exception("no se puede escribir en el archivo: $arch_name");
						 fwrite($archivo_comanda,"\n");
					}
					
					$tail = " \n - Mesa Nº: ".$productos[0]['Comanda']['Mesa']['numero']." -\n";
					fwrite($archivo_comanda,$tail);
				}
			} catch (Exception $e) {
				  return 'Error: '.  $e->getMessage();
			}
			
			
			//si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
			$comando = "lp -d $comandera_name $arch_name";
			$retorno = exec($comando);
			debug("Se mando el comando". $comando." ---El EL JOB ID es->> ".$retorno);
			
			return $retorno;
		endforeach;
		

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