<div class="restaurantes form">
<?php echo $form->create('Restaurante');?>
	<fieldset>
 		<legend><?php __('Edit Restaurante');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Restaurante.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Restaurante.id'))); ?></li>
		<li><?php echo $html->link(__('List Restaurantes', true), array('action'=>'index'));?></li>
	</ul>
</div>
