<div class="fiscalPrinteres view">
<h2><?php  echo __('Fiscal Printer');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Driver'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['driver']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($fiscalPrinter['FiscalPrinter']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Fiscal Printer'), array('action' => 'edit', $fiscalPrinter['FiscalPrinter']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Fiscal Printer'), array('action' => 'delete', $fiscalPrinter['FiscalPrinter']['id']), null, __('Are you sure you want to delete # %s?', $fiscalPrinter['FiscalPrinter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Fiscal Printeres'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Fiscal Printer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
