<div class="tipoDePagos index">
	<h2><?php echo __('Tipo De Pagos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('image_url');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($tipoDePagos as $tipoDePago): ?>
	<tr>
		<td><?php echo h($tipoDePago['TipoDePago']['id']); ?>&nbsp;</td>
		<td><?php echo h($tipoDePago['TipoDePago']['name']); ?>&nbsp;</td>
		<td><?php echo $this->Html->image($tipoDePago['TipoDePago']['image_url'], array('class' => 'tipodepago')); echo h($tipoDePago['TipoDePago']['image_url']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'admin_view', $tipoDePago['TipoDePago']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'admin_add_edit', $tipoDePago['TipoDePago']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'admin_delete', $tipoDePago['TipoDePago']['id']), null, __('Are you sure you want to delete # %s?', $tipoDePago['TipoDePago']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Tipo De Pago'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('controller' => 'pagos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add')); ?> </li>
	</ul>
</div>
