
<script type="text/javascript">
<!--
fabricaMesa = new FabricaMesa(<?php echo $mesa_json?>);
mesaCambiar = fabricaMesa.getMesa();


var fabricaMozo = new FabricaMozo(<?php echo $mozo_json?>);
var mozoCambiar = fabricaMozo.getMozo();

adicion.cambiarMesa(mesaCambiar);
adicion.cambiarMozo(mozoCambiar);

//-->
</script>


<div class="mesas view">
	<ul>
	
 	<?php 
 	echo (sizeof($items)== 0)?"NO HAY ITEMS<br>":"";
 	//debug($items);
 	
 	/**
 	 * 
 	 *  $i tienen la forma:
 	 *  $i['Comanda'][mesa_id]
 	 *  $i['Comanda'][producto_id]
 	 * 	$i[0][cant]
 	 * 	$i['Producto']['name']
 	 *  $i['Mesa']['numero']
 	 *  $i['DetalleSabor'][x][campos]
 	 *  $i['DetalleSabor'][x][Sabor][campos]
 	 */
 	$prod_borrados = array();
	foreach ($items as $i):
		$cantidad = $i[0]['cant'];
		$producto = $i['Producto']['name'];
		if($cantidad > 0)
		{
			echo "<li><b>$cantidad - </b>$producto</li>";	
		}
		else
		{
			array_push($prod_borrados,$i);
		}		
	endforeach;
	?>
	</ul>
	
	<?php 
	if(count($prod_borrados)>0):
	?>	
		<h2>Productos Eliminados</h2>
		<ul>
			<?php 
			foreach ($prod_borrados as $i):
				$producto = $i['Producto']['name'];
				echo "<li>$producto</li>";
			endforeach;
			?>	
		</ul>
	<?php endif;?>
</div>
