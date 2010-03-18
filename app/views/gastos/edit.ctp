<div class="gastos form">
<?php echo $form->create('Gasto');?>
	<fieldset>
 		<legend><?php __('Edit Gasto');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('importe');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Gasto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Gasto.id'))); ?></li>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index'));?></li>
	</ul>
</div>
