<div class="ivaResponsabilidades index">
	<h2><?php echo __('Iva Responsabilidades'); ?></h2>
	<table class="table">
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('codigo_fiscal'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('tipo_factura_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ivaResponsabilidades as $ivaResponsabilidad): ?>
	<tr>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['id']); ?>&nbsp;</td>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']); ?>&nbsp;</td>
		<td><?php echo h($ivaResponsabilidad['IvaResponsabilidad']['name']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ivaResponsabilidad['TipoFactura']['name'], array('controller' => 'tipo_facturas', 'action' => 'view', $ivaResponsabilidad['TipoFactura']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), array(), __('Are you sure you want to delete # %s?', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('controller' => 'tipo_facturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Factura'), array('controller' => 'tipo_facturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
