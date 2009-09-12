<?php $paginator->options(array('update' => 'listado-clientes-ajax'))?>

<div id="listado-clientes-ajax">
	<table>
		<tr class="listado"> 
			<th><?php echo $paginator->sort('Nombre', 'User.nombre'); ?></th> 
			<th><?php echo $paginator->sort('Apellido', 'User.apellido'); ?></th>
			<th><?php echo $paginator->sort('Descuento', 'Descuento.porcentaje'); ?></th>  
			<th>+</th>  
		</tr> 
		   <?php foreach($clientes as $c): ?> 
		<tr  class="listado"> 
			<td><?php echo $c['User']['nombre']; ?> </td> 
			<td><?php echo $c['User']['apellido']; ?> </td>
			<td><?php echo '%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite>'; ?> </td>  
			<td><a href="#AgregarCliente" onclick="agregarClienteACurrentMesa(<?php echo $c['Cliente']['id'];?>)">ADD</a></td> 
		</tr> 
		<?php endforeach; ?> 
	</table> 
</div>

<div id="listado-clientes-paginador">
<ul>
	<!-- Muestra los enlaces para Anterior -->
	<li><?php echo $paginator->prev('« - ', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>
	
	<!-- Muestra los números de página -->
	<?php echo $paginator->numbers(array('tag'=>'li','class'=>'boton')); ?>
	
	<!-- Muestra los enlaces para Siguiente -->	
	<li><?php echo $paginator->next(' + »', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>
	
	<!-- Muestra X de Y, donde X es la página actual e Y el total del páginas -->
	<?php // echo $paginator->counter(); ?>
	</ul>
</div>