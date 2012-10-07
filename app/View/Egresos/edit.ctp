<div class="egresos form">
<?php echo $form->create('Egreso');?>
	<fieldset>
 		<legend><?php __('Edit Egreso');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('total');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Egreso.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Egreso.id'))); ?></li>
		<li><?php echo $html->link(__('List Egresos', true), array('action' => 'index'));?></li>
	</ul>
</div>
