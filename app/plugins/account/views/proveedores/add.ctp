<div class="proveedores form">
<?php echo $form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Add Proveedor');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Proveedores', true), array('action' => 'index'));?></li>
	</ul>
</div>
