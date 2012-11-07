<?php

App::uses('PrinterEngines', 'Lib');


//define('CORTAR_PAPEL','i');

// COMANDOS ESC/P
/*
define('ESC',chr(27));
define('CORTAR_PAPEL',"w");
define('ENFATIZADO',"E1");
define('SACA_ENFATIZADO',"E0");
define('TEXT_STRONG',"");
define('TEXT_NORMAL',"");
define('DOBLE_ALTO',"");
define('SACA_DOBLE_ALTO',"");
*/
App::uses('Component', 'Controller');

// COMANDOS ESC/BEMATECH

define('ESC',chr(27));
define('CORTAR_PAPEL',"w");
define('ENFATIZADO',"E");
define('SACA_ENFATIZADO',"F");
define('TEXT_STRONG',"N4");
define('TEXT_NORMAL',"N2");
define('DOBLE_ALTO',"d1");
define('SACA_DOBLE_ALTO',"d0");


class PrintableBehavior extends ModelBehavior
{
        protected $Model;
        
        /**
         * @var array $comanderas
         *      Listado de comanderas disponibles
         *      find('all') del Modelo Comandera
         */
        protected $comanderas = array();
        
        
        public function setup(&$model){
            $this->Model =& $model;
            $this->Comanda =& ClassRegistry::init('Comanda');
        }



	/**
	 * de todas las comanderas cargadas en el arrat $comanderas, me trae la primera que encuentra
	 * que permita imprimir tickets tipo factura
	 *
	 * @return array['Comandera], false si no encuentra ninguna
	 */
	private function __find_comandera_que_imprima_tickets(){
		foreach($this->comanderas as $c):
		if($c['Comandera']['imprime_ticket']){
			return $c;
		}
		endforeach;
		return false;
	}



	/**
	 * Imprime una Comanda para la cocina
	 *
	 */
	function imprimirComanda($comanda_id){
		

		$productos_x_comanda = array();
		// se supone que en una comanda yo no voy a tener productos que se impriman en comanderas distitas
		// (esto es separado desde el mismo controlador y se manda aimprimir a comandas diferentes)
		// pero , por las dudas que ésto suceda, cuando yo listo los productos de una comanda, me los separa para ser impreso en Comanderas distintas
		// Entonces, por lo genral (SIEMPRE) se imprimiria x 1 sola Comandera en este método del Componente

		//comanderas_involucradas es un array de IDś dlas comaderas involucradas en esta comanda
		$comanderas_involucradas =  $Comanda->comanderas_involucradas($comanda_id);

		$entradas = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_ENTRADAS);
		
		$platos_principales = $Comanda->listado_de_productos_con_sabores($comanda_id, DETALLE_COMANDA_TRAER_PLATOS_PRINCIPALES);

		
		$productos = array_merge($entradas, $platos_principales);

		// genero el array lindo paraimprimir por cada comanda
		// o sea, genero un renglón de la comanda
		// por ejmeplo me queraria algo asi:
		// "1) Milanesa de pollo\n"
		foreach($comanderas_involucradas as $comandera_id):
			
			$cant_entradas = count($entradas);
			if($cant_entradas >0){
					$prod_a_imprimir[] =	" -----        ENTRADAS       -----";
					$prod_a_imprimir[] = 	" ";
			}
			$i = 0;
			foreach($productos as $detalle):
				if(($i == $cant_entradas) && count($platos_principales)>0){
					$prod_a_imprimir[] = 	" ";
					$prod_a_imprimir[] =	" -----   PLATOS PRINCIPALES   -----";
					$prod_a_imprimir[] = 	" ";
				}
				
				// solo imprimir el producto que se imprime con esta comandera
				if($detalle['Producto']['comandera_id']==$comandera_id){
					$prod_cant = $detalle['DetalleComanda']['cant'];
					$prod_name = $detalle['Producto']['name'].' - '.$detalle['DetalleComanda']['observacion'];
					$prod_sabor = '';
					$primero = true;
					foreach ( $detalle['DetalleSabor'] as $sabor){
						if(!$primero){
							$prod_sabor .= ', ' ;
						}
						else{
							$prod_sabor .= ':: [' ;
							$primero = false;
						}
						$prod_sabor .= $sabor['Sabor']['name'];
					}
					$prod_sabor .= (count($detalle['DetalleSabor']) == 0)?'':']';
						
					$prod_a_imprimir[] =	"$prod_cant) $prod_name $prod_sabor";
				}
				$i++;
			endforeach;
			
			// imprimo el array de esta primer comanda
			try {
                            $textoAImprimir = '';
                            App::import('Vendor', 'TicketTemplates', array('file' => 'TicketTemplates' . DS . 'comanda_comandera.php'));
                            debug($TicketTemplates);
			} catch (Exception $e) {
                            return 'Error: '.  $e->getMessage();
			}
                        
                        
                        //si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];
                        $serverImpresoraFiscal = Configure::read('ImpresoraFiscal.server');
                        return $this->cupsPrint($serverImpresoraFiscal, $comandera_name, $textoAImprimir);
				
			return $retorno;
		endforeach;
	}




	/**
         * IMPRESION DE PRE-TICKET
	 * Imprime un ticket en la comandera, pr lo general es utilizado para mostrar previamente al ticket
	 *
	 * @param array $productos
	 * @param number $mozo_nro
	 * @param number $mesa_nro
	 * @param number $porcentaje_descuento Ej: 15, 21, 0
	 * @return boolean si salio todo bien true
	 */
	function imprimirTicketConComandera($productos, $mozo , $mesa, $porcentaje_descuento = 0){
		$this->__inicio_manual();
                $prod_a_imprimir = array();
		if($comandera = $this->__find_comandera_que_imprima_tickets()){
			$comandera_id = $comandera['Comandera']['id'];
				
			$total = 0;
			$j = 0;
			foreach($productos as $detalle):
			// solo imprimir el producto que se imprime con esta comandera
				$prod_cant = $detalle['cantidad'];
				$prod_name = $detalle['nombre'];
				$prod_precio = $detalle['precio'];
				$prod_precio_total = cqs_round($prod_cant*$prod_precio*100)/100; // esto se hace para que siempre me devualva con 2 ddecimales
				$total += $prod_precio_total;
				$prod_a_imprimir[$j] =	"$prod_cant x $prod_precio: $prod_name";
				if(strlen($prod_a_imprimir[$j])>30){
					$prod_a_imprimir[$j] = substr($prod_a_imprimir[$j],0,40);
				}
				
				for($i= strlen($prod_a_imprimir[$j])+strlen($total); $i<36;$i++){
					$prod_a_imprimir[$j] .= ".";
				}
				
				$prod_a_imprimir[$j] .=	"$$prod_precio_total";
				$j++;
			endforeach;
				
                        $textoAImprimir = '';
				
                        // armo el temṕlate del ticket importando el archivo de templates
                        
                        try {
                            
                            App::import('Vendor', 'TicketTemplates', array('file' => 'TicketTemplates' . DS . 'pre_ticket_comandera.php'));
                            PreTicketComandera::output($textoAImprimir, $prod_a_imprimir, $porcentaje_descuento, $total, $mozo, $mesa );
                            
			} catch (Exception $e) {
                            return 'Error: '.  $e->getMessage();
			}
				
			//si paso todo bien la creacion del archivo la mando a imprimir
			$comandera_name = $this->comanderas[$comandera_id]['Comandera']['name'];                        
                        return $this->cupsPrint($comandera_name, $textoAImprimir);
		}
		else return false;
	}
        
}
?>
