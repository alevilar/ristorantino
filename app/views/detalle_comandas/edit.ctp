<div class="comandas form">
<?php echo $form->create('DetalleComanda');?>
	<fieldset>
 		<legend><?php __('Edit Comanda');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('producto_id');
		echo $form->input('cant');
		echo $form->input('mesa_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comanda.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comanda.id'))); ?></li>
		<li><?php echo $html->link(__('List Comandas', true), array('action'=>'index'));?></li>
	</ul>
</div>
