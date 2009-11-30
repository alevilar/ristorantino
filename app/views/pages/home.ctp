

<div id='botonera_home' class="menu-horizontal">
<table>
	<tr>
		<td><?php echo $html->link('Adición','/adicion/home',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-adicion'));?></td>
		<td><?php echo $html->link('Admin','/pages/administracion',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-admin'));?></td>
	</tr>
	<tr>
	 	<td><?php echo $html->link('Caja','/cajero/cobrar',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-caja'));?></td>
	 	<td><?php echo $html->link('Estadisticas','/queries/descargar_queries',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-estadisticas'));?></td>
</table>
</div>