<div class="printers index">
	<h2><?php echo __('Printers'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('alias'); ?></th>
			<th><?php echo $this->Paginator->sort('driver'); ?></th>
			<th><?php echo $this->Paginator->sort('output'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($printers as $printer): ?>
	<tr>
		<td><?php echo h($printer['Printer']['id']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['name']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['alias']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['driver']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['output']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['created']); ?>&nbsp;</td>
		<td><?php echo h($printer['Printer']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $printer['Printer']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $printer['Printer']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $printer['Printer']['id']), array(), __('Are you sure you want to delete # %s?', $printer['Printer']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Printer'), array('action' => 'add')); ?></li>
	</ul>
</div>
