
<script type="text/javascript">
<!--
fabricaMesa = new FabricaMesa(<?php echo json_encode($mesa)?>);
mesaCambiar = fabricaMesa.getMesa();


var fabricaMozo = new FabricaMozo(<?php echo $mozo_json?>);
var mozoCambiar = fabricaMozo.getMozo();

adicion.cambiarMesa(mesaCambiar);
adicion.cambiarMozo(mozoCambiar);


$("btn-cambio-rapido-de-mesa").update("Mesa "+mesaCambiar.numero+"<br />Mozo "+mozoCambiar.numero);

//-->
</script>


<div class="mesas view">
	<ul>
	
 	<?php 
 	echo (sizeof($items)== 0)?"NO HAY ITEMS<br>":"";
 	//debug($items);
 	$comanda_ant = '';
 	
 	$prod_borrados = array();
	foreach ($items as $i):
		$cantidad = $i['DetalleComanda']['cant']-$i['DetalleComanda']['cant_eliminada'];
		$producto = $i['Producto']['name'];
		
		if($comanda_ant != $i['DetalleComanda']['comanda_id'] ){
			$comanda_ant = $i['DetalleComanda']['comanda_id'];
			if($session->read('Auth.User.role') == 'mozo'){
				echo "<h2>Comanda #".$comanda_ant."</h2>";
			}
			else{
				echo "<h2>".$html->link("Comanda #$comanda_ant",array('controller'=>'comandas','action'=>'imprimir',$comanda_ant))."</h2>";		
			}
		}
		
			echo "<li><b>$cantidad - </b>$producto</li>";
			if(count($i['DetalleSabor'])>0){
				$esPrimero = true;
				echo "(";
				foreach($i['DetalleSabor'] as $sabor):
					
					if(!$esPrimero){
						echo ", ";
					}
					else $esPrimero = false;
					echo $sabor['Sabor']['name'];
				endforeach;
				echo ")";
			}		
	endforeach;
	?>
	</ul>
	
</div>