<div class="comanderas form">
<?php echo $form->create('Comandera');?>
	<fieldset>
 		<legend><?php __('Edit Comandera');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('imprime_ticket');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comandera.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comandera.id'))); ?></li>
		<li><?php echo $html->link(__('List Comanderas', true), array('action'=>'index'));?></li>
	</ul>
</div>
