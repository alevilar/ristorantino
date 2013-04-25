<div class="ivaResponsabilidades form">
<?php echo $this->Form->create('IvaResponsabilidad');?>
	<fieldset>
		<legend><?php echo __('Edit Iva Responsabilidad'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('codigo_fiscal');
		echo $this->Form->input('name');
		echo $this->Form->input('tipo_factura_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('IvaResponsabilidad.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('IvaResponsabilidad.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('controller' => 'tipo_facturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Factura'), array('controller' => 'tipo_facturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
