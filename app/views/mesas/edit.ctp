
<div class="mesas form">
<?php echo $form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Editar Mesa');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('numero',array('after'=>'Escriba otro número de mesa.','label'=>'Cambiar Número de Mesa'));
		echo $form->input('mozo_id',array('after'=>'Seleccione un nuevo mozo para ésta mesa'));
		echo $form->input('total',array('after'=>'OJO !!! Cuando una mesa ya esta cerrada, cuando se modifica el total, se modifica el verdadero valor final de la mesa.'));
	?>
	</fieldset>
<?php echo $form->end('Guardar Cambios');?>
</div>




<h2>Detalles de la Mesa</h2>

<h3>Cliente</h3>
<dl>
<?php

	echo "<dt>Tipo Factura</dt>";
	if ($mesa['Cliente']['tipofactura'] == ''){
		$tipofac = "B";
		$mesa['Cliente']['tipofactura'] = "B";
	}
	
	if ($mesa['Cliente']['tipofactura'] === 0){
		$tipofac = 'Remito';	
	}
	else{
		$tipofac = $mesa['Cliente']['tipofactura'];
	}
	
	echo "<dd>\"$tipofac\" &nbsp;</dd>";
	
	if(empty($mesa['Cliente']['tipofactura'])){
		echo "<dt>Nombre</dt>";
		echo "<dd>". $mesa['Cliente']['nombre']."&nbsp;</dd>";
	
		echo "<dt>Descuento</dt>";
		$dto = (!empty($mesa['Cliente']['Descuento']['porcentaje']))?$mesa['Cliente']['Descuento']['porcentaje']:"0";
		echo "<dd>". $dto."% &nbsp;</dd>";
	}
	
	echo "<dt>Imprime Ticket</dt>";
	echo "<dd>". ($mesa['Cliente']['imprime_ticket'])?'SI':'NO'."&nbsp;</dd>";
?>
</dl>

<?php 
echo "Abrió a las ".date('H:i', strtotime($this->data['Mesa']['created']));
?>

<ul>

<?php
$total = 0; 
foreach($items as $comanda):
	 echo "<li>ID: ";
	 echo "#".$comanda['id']."</li>";
	 echo $html->link("Reimprimir Comanda #".$comanda['id'],array('controller'=>'comandas','action'=>'imprimir',$comanda['id']));
	 if($comanda['observacion']){
	 echo "<li><cite>Observacion:</cite> ";
	 echo $comanda['observacion']."</li>";
	 }
	 
	 
	 ?>
	 <ul>
	 <?php foreach($comanda['DetalleComanda'] as $detalle){?>
	 	<li>
	 		<?php echo "Cant Pedida: ".$detalle['cant']." Sacada: ".$detalle['cant_eliminada'] ?>
	 		<br>
	 		<span style="color: maroon; <?php  if(($detalle['cant']-$detalle['cant_eliminada'])==0) echo "text-decoration: line-through;"?> ">
	 			<?php  echo $detalle['cant']-$detalle['cant_eliminada'].")  ".$detalle['Producto']['name']." [p-u $ ".$detalle['Producto']['precio']."]"?>
	 		</span>
	 	</li>
	 	<?php if(count($detalle['DetalleSabor'])>0){
	 				$primero = true;
	 			echo "(";
	 			 foreach($detalle['DetalleSabor'] as $sabor){
	 			 	if(!$primero){
	 			 		echo ", ";
	 			 	}
	 			 	$primero = false;
	 			 	echo $sabor['Sabor']['name']." [ $".$sabor['Sabor']['precio']."]";
	 			 	$total += ($detalle['cant']-$detalle['cant_eliminada'])*$sabor['Sabor']['precio'];
	 			 }
	 			 echo ")";
	 	}
	 	
		$total += ($detalle['cant']-$detalle['cant_eliminada'])*$detalle['Producto']['precio'];
	 	}?>
	 </ul>
	 
	 
	 <hr />
	 <?php 
endforeach;

?>

</ul>


	 


<?php 

echo "<h3>SUBTOTAL = $$total</h3>";
echo "<h4>Total almacenado en Base de Datos: $$subtotal<h4> (este valor debe conicidir con el de arriba)";
?>


<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Mesa.id')), null, sprintf('Seguro que querés borrar la mesa Número # %s?', $form->value('Mesa.numero'))); ?></li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('action'=>'index'));?></li>
	</ul>
</div>