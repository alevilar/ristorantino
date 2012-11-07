<div class="comanderas form">
<?php echo $this->Form->create('Comandera');?>
	<fieldset>
		<legend><?php echo __('Edit Comandera'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('driver_name');
		echo $this->Form->input('path');
		echo $this->Form->input('imprime_ticket');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Comandera.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('Comandera.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Comanderas'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Producto'), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
