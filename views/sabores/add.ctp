<div class="sabores form">
<?php echo $form->create('Sabor');?>
	<fieldset>
 		<legend><?php __('Add Sabor');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('categoria_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>
