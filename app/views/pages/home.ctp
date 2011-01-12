

<div id='botonera_home' class="menu-horizontal">
<table>
	<tr>
		<td><?php echo $html->link('Adición','/adition/aditions/adicionar',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-adicion'));?></td>
		<td><?php echo $html->link('Admin','/pages/administracion',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-admin'));?></td>
	</tr>
	<tr>
	 	<td>
                    <? echo $html->link('Caja', '/old_cashier/cajeros/cobrar', array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-caja')); ?>
                    <!--
                    <table>
                        <tr>
                            <td><?php echo $html->link('Caja','/cashier/cashiers/cobrar',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-caja'));?></td>
                            <td><? echo $html->link('Vieja Caja', '/old_cashier/cajeros/cobrar', array('class'=>'boton redondeado')); ?></td>
                        </tr>
                    </table>
                    -->
                </td>
	 	<td><?php echo $html->link('Estadisticas','/pquery/queries/descargar_queries',array('class'=>'boton redondeado','style'=>'margin:auto;', 'id'=>'bton-estadisticas'));?></td>
</table>

<?php echo $html->link('Cambiar de usuario', array('controller'=>'users', 'action'=>'logout')); ?>
</div>