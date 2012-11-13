<div class="sabores form">
<?php echo $this->Form->create('Sabor');?>
	<fieldset>
		<legend><?php echo __('Add Sabor'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('categoria_id');
		echo $this->Form->input('precio');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Sabores'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
	</ul>
</div>
