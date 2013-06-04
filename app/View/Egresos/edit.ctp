<div class="egresos form">
<?php echo $this->Form->create('Egreso');?>
	<fieldset>
 		<legend><?php echo __('Edit Egreso');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('total');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $this->Form->value('Egreso.id')), null, sprintf(__('Are you sure you want to delete # %s?'), $this->Form->value('Egreso.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Egresos'), array('action' => 'index'));?></li>
	</ul>
</div>
