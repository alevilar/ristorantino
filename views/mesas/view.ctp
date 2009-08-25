<?php 
//esta variable no la uso
 //$mozo_json
 ?>
 
<script type="text/javascript">
<!--
fabricaMesa = new FabricaMesa(<?php echo $mesa_json?>);
mesaCambiar = fabricaMesa.getMesa();

cambiarMesa(mesaCambiar);
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
	foreach ($items as $i):
		$cantidad = $i[0]['cant'];
		$producto = $i['Producto']['name'];
		echo "<li><b>$cantidad - </b>$producto</li>";
	endforeach;
	?>
	</ul>
</div>
