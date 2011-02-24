

<div class="mesas view">
    
	<ul>
	
 	<?php 
 	echo (sizeof($items)== 0)?"NO HAY ITEMS<br>":"";
 	//debug($items);
 	$comanda_ant = '';
 	
 	$prod_borrados = array();
	foreach ($items as $i):
		$cantidad = $i['cantidad'];
		$producto = $i['nombre'];
                $precio = $i['precio'];
		
                echo "<li><b>$cantidad x $$precio- </b>$producto</li>";
	endforeach;
	?>
	</ul>
	<h4>
        <?php echo "Total: $".$mesa_total; ?>
        </h4>
</div>