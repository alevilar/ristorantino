<div class="tipoFacturas form">
<?php echo $this->Form->create('TipoFactura');?>
	<fieldset>
		<legend><?php echo __('Edit Tipo Factura'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('codename');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TipoFactura.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('TipoFactura.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('controller' => 'iva_responsabilidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('controller' => 'iva_responsabilidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
