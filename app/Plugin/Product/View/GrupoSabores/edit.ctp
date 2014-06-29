<div class="grupoSabores form">
<?php echo $this->Form->create('GrupoSabor');?>
	<fieldset>
		<legend><?php echo __('Edit Grupo Sabor'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('seleccion_de_sabor_obligatorio');
		echo $this->Form->input('tipo_de_seleccion');
		echo $this->Form->input('name');
		echo $this->Form->input('Producto');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('GrupoSabor.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('GrupoSabor.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Grupo Sabores'), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Producto'), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
