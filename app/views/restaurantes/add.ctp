<div class="restaurantes form">
<?php echo $form->create('Restaurante');?>
	<fieldset>
 		<legend><?php __('Add Restaurante');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Restaurantes', true), array('action'=>'index'));?></li>
	</ul>
</div>
