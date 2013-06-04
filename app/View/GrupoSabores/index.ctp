<div class="grupoSabores index">
	<h2><?php echo __('Grupo Sabores');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('seleccion_de_sabor_obligatorio');?></th>
			<th><?php echo $this->Paginator->sort('tipo_de_seleccion');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
	foreach ($grupoSabores as $grupoSabor): ?>
	<tr>
		<td><?php echo h($grupoSabor['GrupoSabor']['id']); ?>&nbsp;</td>
		<td><?php echo h($grupoSabor['GrupoSabor']['seleccion_de_sabor_obligatorio']); ?>&nbsp;</td>
		<td><?php echo h($grupoSabor['GrupoSabor']['tipo_de_seleccion']); ?>&nbsp;</td>
		<td><?php echo h($grupoSabor['GrupoSabor']['name']); ?>&nbsp;</td>
		<td><?php echo h($grupoSabor['GrupoSabor']['created']); ?>&nbsp;</td>
		<td><?php echo h($grupoSabor['GrupoSabor']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $grupoSabor['GrupoSabor']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $grupoSabor['GrupoSabor']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $grupoSabor['GrupoSabor']['id']), null, __('Are you sure you want to delete # %s?', $grupoSabor['GrupoSabor']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Grupo Sabor'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Producto'), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
