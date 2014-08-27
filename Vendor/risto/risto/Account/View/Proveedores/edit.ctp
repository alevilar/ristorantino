
<div class="proveedores form">
<?php echo $this->Form->create('Proveedor');?>
	<fieldset>
 		<legend><?php __('Editar Proveedor');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name', array('label'=>'Nombre'));
		echo $this->Form->input('cuit');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
	?>
<?php echo $this->Form->end('Guardar');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $this->Form->value('Proveedor.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Proveedor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Proveedores', true), array('action' => 'index'));?></li>
	</ul>
</div>
