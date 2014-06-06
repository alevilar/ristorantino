<div class="tipoFacturas form">
<?php echo $this->Form->create('TipoFactura');?>
	<fieldset>
 		<legend><?php __('Add TipoFactura');?></legend>
	<?php
		echo $this->Form->input('name');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('List TipoFacturas', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Egresos', true), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso', true), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
	</ul>
</div>
