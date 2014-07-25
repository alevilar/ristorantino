<div class="comanderas form">
<?php echo $this->Form->create('Comandera');?>
	<fieldset>
 		<legend><?php __('Edit Comandera');?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('path');
		echo $this->Form->input('imprime_ticket');
	?>
	</fieldset>
<?php echo $this->Form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Delete', true), array('action'=>'delete', $this->Form->value('Comandera.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Comandera.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Comanderas', true), array('action'=>'index'));?></li>
	</ul>
</div>
