<div class="tipoFacturas form">
<?php echo $this->Form->create('TipoFactura');?>
	<fieldset>
 		<legend><?php __('Edit TipoFactura');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('TipoFactura.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('TipoFactura.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List TipoFacturas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Egresos', true), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso', true), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
	</ul>
</div>
