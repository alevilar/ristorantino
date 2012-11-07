<div class="comandas form">
<?php echo $this->Form->create('DetalleComanda');?>
	<fieldset>
 		<legend><?php echo __('Edit Comanda');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('producto_id');
		echo $this->Form->input('cant');
		echo $this->Form->input('mesa_id');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $this->Form->value('Comanda.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Comanda.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Comandas'), array('action'=>'index'));?></li>
	</ul>
</div>
