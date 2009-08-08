<div class="productos form">
<?php echo $form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Add Producto');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('abrev');
		echo $form->input('description');
		echo $form->input('categoria_id');
		echo $form->input('precio');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
