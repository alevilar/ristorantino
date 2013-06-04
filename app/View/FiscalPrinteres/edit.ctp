<div class="fiscalPrinteres form">
<?php echo $this->Form->create('FiscalPrinter');?>
	<fieldset>
		<legend><?php echo __('Edit Fiscal Printer'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('name');
		echo $this->Form->input('driver');
		echo $this->Form->input('path');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit'));?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('FiscalPrinter.id')), null, __('Are you sure you want to delete # %s?', $this->Form->value('FiscalPrinter.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Fiscal Printeres'), array('action' => 'index'));?></li>
	</ul>
</div>
