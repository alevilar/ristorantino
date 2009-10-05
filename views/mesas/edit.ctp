<div class="mesas form">
<?php echo $form->create('Mesa');?>
	<fieldset>
 		<legend><?php __('Edit Mesa');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('numero');
		echo $form->input('mozo_id');
		echo $form->input('total');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Borrar', true), array('action'=>'delete', $form->value('Mesa.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Mesa.id'))); ?></li>
		<li><?php echo $html->link(__('Listar Mesas', true), array('action'=>'index'));?></li>
	</ul>
</div>
