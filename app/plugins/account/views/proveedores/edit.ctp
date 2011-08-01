<div class="proveedores form">
<?php echo $form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Edit Proveedor');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('cuit');
		echo $form->input('mail');
		echo $form->input('telefono');
		echo $form->input('domicilio');
	?>
	</fieldset>
<?php echo $form->end('Guardar');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action' => 'delete', $form->value('Proveedor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Proveedor.id'))); ?></li>
		<li><?php echo $html->link(__('List Proveedores', true), array('action' => 'index'));?></li>
	</ul>
</div>
