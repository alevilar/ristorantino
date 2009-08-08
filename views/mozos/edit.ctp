<div class="mozos form">
<?php echo $form->create('Mozo');?>
	<fieldset>
 		<legend><?php __('Edit Mozo');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('user_id');
		echo $form->input('numero');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Mozo.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Mozo.id'))); ?></li>
		<li><?php echo $html->link(__('List Mozos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mesa', true), array('controller'=> 'mesas', 'action'=>'add')); ?> </li>
	</ul>
</div>
