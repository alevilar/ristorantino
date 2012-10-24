<div class="users form">
<?php echo $this->Form->create('User');?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('rol_id');
		echo $this->Form->input('nombre');
		echo $this->Form->input('apellido');
		echo $this->Form->input('telefono');
		echo $this->Form->input('domicilio');
		echo $this->Form->input('numero');
		echo $this->Form->input('deleted');
		echo $this->Form->input('deleted_date');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rol'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Egresos'), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mozos'), array('controller' => 'mozos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mozo'), array('controller' => 'mozos', 'action' => 'add')); ?> </li>
	</ul>
</div>
