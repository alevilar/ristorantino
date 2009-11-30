<div class="sabores form">
<?php echo $form->create('Sabor');?>
	<fieldset>
 		<legend><?php __('Edit Sabor');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('categoria_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Sabor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Sabor.id'))); ?></li>
		<li><?php echo $html->link(__('List Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>
