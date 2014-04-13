<div class="roles form">
<?php echo $form->create('Rol');?>
	<fieldset>
		<legend><?php echo __('Edit Rol'); ?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('machin_name', array('disabled'=> true));
	?>
	</fieldset>
<?php echo $form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Rol.id')), null, 'Are you sure you want to delete?'); ?></li>
		<li><?php echo $html->link(__('List Roles', true), array('action' => 'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
