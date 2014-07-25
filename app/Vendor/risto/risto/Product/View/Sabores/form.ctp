
<div class="sabores form">
<?php echo $this->Form->create('Sabor');?>
<fieldset>
 		<legend><?php __('Editar Sabor');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('categoria_id');
		echo $this->Form->input('precio');
	?>
<?php echo $this->Form->end('Submit');?>
</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Borrar', true), array('action'=>'delete', $this->Form->value('Sabor.id')), null, sprintf(__('¿Esta seguro que desea borrar el sabor: %s?', true), $this->Form->value('Sabor.name'))); ?></li>
		<li><?php echo $this->Html->link(__('Listar Sabores', true), array('action'=>'index'));?></li>
	</ul>
</div>
