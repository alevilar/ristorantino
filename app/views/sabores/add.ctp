<div class="sabores form">
<?php echo $form->create('Sabor');?>
	<fieldset>
 		<legend><?php __('Crear Sabor');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('categoria_id');
		echo $form->input('precio');
	?>
<?php echo $form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>
