<div class="clientes form">
<?php echo $this->Form->create('Cliente'); ?>
	<fieldset>
		<legend><?php echo __('Add Cliente'); ?></legend>
	<?php
		echo $this->Form->input('codigo');
		echo $this->Form->input('mail');
		echo $this->Form->input('telefono');
		echo $this->Form->input('descuento_id');
		echo $this->Form->input('tipofactura');
		echo $this->Form->input('nombre');
		echo $this->Form->input('nrodocumento');
		echo $this->Form->input('tipo_documento_id');
		echo $this->Form->input('domicilio');
		echo $this->Form->input('responsabilidad_iva');
		echo $this->Form->input('iva_responsabilidad_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Clientes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Descuentos'), array('controller' => 'descuentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Descuento'), array('controller' => 'descuentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Documentos'), array('controller' => 'tipo_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Documento'), array('controller' => 'tipo_documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('controller' => 'iva_responsabilidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('controller' => 'iva_responsabilidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
