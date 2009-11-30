<div class="comandas form">
<?php echo $form->create('Comanda');?>
	<fieldset>
 		<legend><?php __('Edit Comanda');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('prioridad');
		echo $form->input('impresa');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comanda.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comanda.id'))); ?></li>
		<li><?php echo $html->link(__('List Comandas', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Detalle Comandas', true), array('controller'=> 'detalle_comandas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Detalle Comanda', true), array('controller'=> 'detalle_comandas', 'action'=>'add')); ?> </li>
	</ul>
</div>
