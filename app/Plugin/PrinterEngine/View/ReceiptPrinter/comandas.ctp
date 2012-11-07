<?php

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
			                        
                        