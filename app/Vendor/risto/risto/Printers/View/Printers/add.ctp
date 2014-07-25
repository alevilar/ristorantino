<div class="printers form">
<?php echo $this->Form->create('Printer'); ?>
	<fieldset>
		<legend><?php echo __('Add Printer'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('alias');
		echo $this->Form->input('driver');
		echo $this->Form->input('output');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Printers'), array('action' => 'index')); ?></li>
	</ul>
</div>
