

<div id='botonera_home' class="menu-horizontal">
<table>
	<tr>
		<td><?php echo $html->link('Adición','/adition/adicionar',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-adicion'));?></td>
		<td><?php echo $html->link('Admin','/pages/administracion',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-admin'));?></td>
	</tr>
	<tr>
	 	<td><?php echo $html->link('Caja','/cashier/cobrar',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-caja'));?></td>
	 	<td>
			<?php echo $html->link('Estadisticas','/pquery/queries/descargar_queries',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-estadisticas'));?>
			<table><tr><td>
			<?php echo $html->link('Ventas','/pquery/queries/list_view/5',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?></td>
		<td>
<?php echo $html->link('Ventas Mozo','/pquery/queries/list_view/10',array('class'=>'boton 		redondeado','style'=>'margin:auto;', 'class'=>'boton'));?>
			</td></tr></table>
		</td>
</table>

<?php echo $html->link('Cambiar de usuario', array('controller'=>'users', 'action'=>'logout')); ?>
</div>
