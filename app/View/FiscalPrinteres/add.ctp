<div class="fiscalPrinteres form">
<?php echo $this->Form->create('FiscalPrinter');?>
	<fieldset>
		<legend><?php echo __('Add Fiscal Printer'); ?></legend>
	<?php
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

		<li><?php echo $this->Html->link(__('List Fiscal Printeres'), array('action' => 'index'));?></li>
	</ul>
</div>
