<div class="mesas form">
<?php echo $form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Add Mesa');?></legend>
	<?php
		echo $form->input('numero', array('label'=>'Numero de Mesa', 'after'=>'Ojo que este dato modifica el valor estadistico acumulado por mesa. Lo ideal seria poner el numero de mesa verdadero, caso contrario poner un numero raro. Lo ideal seria poner el Numero 1000'));
		echo $form->input('mozo_id');
		echo $form->input('total', array('label'=>'Importe Total'));
		//echo $form->input('descuento_id');
		//echo $form->input('created');
		//echo $form->input('time_paso_pedido');
		//echo $form->input('time_cerro');
		echo $form->input('time_cobro', array('label'=>'Indicar Fecha y otra aproximada',
                    'after'=>'<br>tener en cuenta que esto puede repercutir en la estadistica general. Hay que intentar poner horarios dispersos a lo largo del dia. Por ejemplo, seria malo si se pone que todas las mesas vinieron a las 22hs. Por otro lado, se puede poner un horario raro, asi cuando se sacan las estadisticas se sabe que por ejemplo, todas las mesas que ocmieron a las 18hs son puestas por nosotros a mano. Esta es quizas la mejor opcion.'));

                echo $form->input('tipo_de_pago',array('options'=>$tipo_pagos))
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Mesas', true), array('action'=>'index'));?></li>
	</ul>
</div>
