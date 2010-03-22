<div class="mesas form">
<?php echo $form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Add Mesa');?></legend>
	<?php
		echo $form->input('numero');
		echo $form->input('mozo_id');
		echo $form->input('total');
		//echo $form->input('descuento_id');
		//echo $form->input('created');
		//echo $form->input('time_paso_pedido');
		//echo $form->input('time_cerro');
		echo $form->input('time_cobro');

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
