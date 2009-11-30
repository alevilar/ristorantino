<div class="comensales form">
<?php echo $form->create('Comensal');?>
	<fieldset>
 		<legend><?php __('Edit Comensal');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('cant_mayores');
		echo $form->input('cant_menores');
		echo $form->input('cant_bebes');
		echo $form->input('mesa_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Comensal.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Comensal.id'))); ?></li>
		<li><?php echo $html->link(__('List Comensales', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mesa', true), array('controller'=> 'mesas', 'action'=>'add')); ?> </li>
	</ul>
</div>
