
<div class="mesas form">
<?php echo $form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Editar Mesa');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('numero',array('after'=>'Escriba otro número de mesa.','label'=>'Cambiar Número de Mesa'));
		echo $form->input('mozo_id',array('after'=>'Seleccione un nuevo mozo para ésta mesa'));
	?>
	</fieldset>
<?php echo $form->end('Guardar Cambios');?>
</div>




<h2>Detalles de la Mesa</h2>

<h3>Cliente</h3>
<dl>
<?php 
	echo "<dt>Tipo Factura</dt>";
	echo "<dd>". $mesa['Cliente']['tipofactura']."&nbsp;</dd>";
	
	echo "<dt>Nombre</dt>";
	echo "<dd>". $mesa['Cliente']['nombre']."&nbsp;</dd>";
	
	echo "<dt>Imprime Ticket</dt>";
	echo "<dd>". ($mesa['Cliente']['imprime_ticket'])?'SI':'NO'."&nbsp;</dd>";
?>
</dl>

<?php 
echo "Abrió a las ".date('H:i', strtotime($this->data['Mesa']['created']));
?>

<dl>

<?php
$total = 0; 
foreach($items as $i):
	 echo "<dt>". $i[0]['cant'].') '.$i['Producto']['name']." . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . . .</dt>";
	 
	 echo "<dd>$".$i['Producto']['precio'].' x '.$i[0]['cant'].' = $'.$i['Producto']['precio']*$i[0]['cant'] ."</dd>";
		if(!empty($i['DetalleSabor'])):
			echo "<cite>";
			foreach($i['DetalleSabor'] as $sabor):
				echo " - ".$sabor['Sabor']['name']."($".$sabor['Sabor']['precio'].")";
			endforeach;
			echo "</cite><br>";
		endif;
	$total += $i['Producto']['precio']*$i[0]['cant']; 
endforeach;

?>

</dl>


<?php 

echo "<h3>SUBTOTAL = $$total</h3>"
?>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Mesa.id')), null, sprintf('Seguro que querés borrar la mesa Número # %s?', $form->value('Mesa.numero'))); ?></li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('action'=>'index'));?></li>
	</ul>
</div>