
 
<script type="text/javascript">
<!--
fabricaMesa = new FabricaMesa(<?php echo $mesa_json?>);
mesaCambiar = fabricaMesa.getMesa();

adicion.cambiarMesa(mesaCambiar);
//-->
</script>


<div class="mesas view">
	<ul>
	
 	<?php 
 	echo (sizeof($items)== 0)?"NO HAY ITEMS<br>":"";
 	
 	
 	/**
 	 * 
 	 *  $i tienen la forma:
 	 *  $i['Comanda'][mesa_id]
 	 *  $i['Comanda'][producto_id]
 	 * 	$i[0][cant]
 	 * 	$i['Producto']['name']
 	 *  $i['Mesa']['numero']
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
