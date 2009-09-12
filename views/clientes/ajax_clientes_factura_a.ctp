<?php $paginator->options(array('update' => 'listado-clientes-ajax'))?>

<div id="listado-clientes-ajax">
	<table>
		<tr class="listado"> 
			<th><?php echo $paginator->sort('Cuit', 'cuit'); ?></th> 
			<th><?php echo $paginator->sort('Denominación', 'denominacion'); ?></th>
			<th><?php echo $paginator->sort('Domicilio', 'domicilio_fiscal'); ?></th>  
			<th>+</th>  
		</tr> 
		   <?php foreach($clientes as $c): ?> 
		<tr  class="listado"> 
			<td><?php echo $c['Cliente']['cuit']; ?> </td> 
			<td><?php echo $c['Cliente']['denominacion']; ?> </td>
			<td><?php echo $c['Cliente']['domicilio_fiscal']; ?> </td>  
			<td><a href="#AgregarCliente" onclick="agregarClienteACurrentMesa(<?php echo $c['Cliente']['id'];?>)">ADD</a></td> 
		</tr> 
		<?php endforeach; ?> 
	</table> 
</div>
<!-- Muestra los números de página -->
<?php echo $paginator->numbers(); ?>
<!-- Muestra los enlaces para Anterior y Siguiente -->
<?php
	echo $paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
	echo $paginator->next(' Next »', null, null, array('class' => 'disabled'));
?> 
<!-- Muestra X de Y, donde X es la página actual e Y el total del páginas -->
<?php echo $paginator->counter(); ?>