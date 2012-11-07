<?php

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