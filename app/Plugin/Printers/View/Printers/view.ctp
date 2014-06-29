<div class="printers view">
<h2><?php echo __('Printer'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Alias'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['alias']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Driver'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['driver']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Output'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['output']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($printer['Printer']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Printer'), array('action' => 'edit', $printer['Printer']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Printer'), array('action' => 'delete', $printer['Printer']['id']), null, __('Are you sure you want to delete # %s?', $printer['Printer']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Printers'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Printer'), array('action' => 'add')); ?> </li>
	</ul>
</div>
