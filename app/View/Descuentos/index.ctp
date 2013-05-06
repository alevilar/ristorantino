<div class="descuentos index">
	<h2><?php echo __('Descuentos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('description');?></th>
			<th><?php echo $this->Paginator->sort('porcentaje');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($descuentos as $descuento): ?>
	<tr>
		<td><?php echo h($descuento['Descuento']['name']); ?>&nbsp;</td>
		<td><?php echo h($descuento['Descuento']['description']); ?>&nbsp;</td>
		<td><?php echo h($descuento['Descuento']['porcentaje']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $descuento['Descuento']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $descuento['Descuento']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $descuento['Descuento']['id']), null, __('Are you sure you want to delete # %s?', $descuento['Descuento']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Descuento'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
