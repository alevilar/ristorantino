<div class="descuentos form">
<?php echo $form->create('Descuento');?>
	<fieldset>
 		<legend><?php __('Edit Descuento');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('porcentaje');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Descuento.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Descuento.id'))); ?></li>
		<li><?php echo $html->link(__('List Descuentos', true), array('action'=>'index'));?></li>
	</ul>
</div>
