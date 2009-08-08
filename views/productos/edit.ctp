<div class="productos form">
<?php echo $form->create('Producto');?>
	<fieldset>
 		<legend><?php __('Edit Producto');?></legend>
	<?php
		echo $form->input('id');
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
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Producto.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Producto.id'))); ?></li>
		<li><?php echo $html->link(__('List Productos', true), array('action'=>'index'));?></li>
	</ul>
</div>
