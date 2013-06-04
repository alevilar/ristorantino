<div class="pagos form">
<?php echo $this->Form->create('Pago');?>
	<fieldset>
 		<legend><?php echo __('Edit Pago');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('mesa_id');
		echo $this->Form->input('tipo_de_pago_id');
		echo $this->Form->input('valor');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete'), array('action'=>'delete', $this->Form->value('Pago.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Pago.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('action'=>'index'));?></li>
	</ul>
</div>
