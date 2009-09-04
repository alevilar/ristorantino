<div class="comandas form">
<?php echo $form->create('Comanda');?>
	<fieldset>
 		<legend><?php __('Add Comanda');?></legend>
	<?php
		echo $form->input('prioridad');
		echo $form->input('impresa');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Comandas', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Detalle Comandas', true), array('controller'=> 'detalle_comandas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Detalle Comanda', true), array('controller'=> 'detalle_comandas', 'action'=>'add')); ?> </li>
	</ul>
</div>
