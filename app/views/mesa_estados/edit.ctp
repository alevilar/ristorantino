<div class="mesaEstados form">
<?php echo $form->create('MesaEstado');?>
	<fieldset>
 		<legend><?php __('Edit MesaEstado');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('parent_id');
		echo $form->input('name');
		echo $form->input('lft');
		echo $form->input('rght');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('MesaEstado.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('MesaEstado.id'))); ?></li>
		<li><?php echo $html->link(__('List MesaEstados', true), array('action' => 'index'));?></li>
	</ul>
</div>
