<div class="sabores view">
<h2><?php  echo __('Sabor');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo $this->Html->link($sabor['Categoria']['name'], array('controller' => 'categorias', 'action' => 'view', $sabor['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Precio'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['precio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted Date'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['deleted_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Deleted'); ?></dt>
		<dd>
			<?php echo h($sabor['Sabor']['deleted']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sabor'), array('action' => 'edit', $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Sabor'), array('action' => 'delete', $sabor['Sabor']['id']), null, __('Are you sure you want to delete # %s?', $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sabores'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sabor'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categorias'), array('controller' => 'categorias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Categoria'), array('controller' => 'categorias', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Detalle Sabores'), array('controller' => 'detalle_sabores', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Detalle Sabor'), array('controller' => 'detalle_sabores', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Detalle Sabores');?></h3>
	<?php if (!empty($sabor['DetalleSabor'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Detalle Comanda Id'); ?></th>
		<th><?php echo __('Sabor Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($sabor['DetalleSabor'] as $detalleSabor): ?>
		<tr>
			<td><?php echo $detalleSabor['id'];?></td>
			<td><?php echo $detalleSabor['detalle_comanda_id'];?></td>
			<td><?php echo $detalleSabor['sabor_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'detalle_sabores', 'action' => 'view', $detalleSabor['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'detalle_sabores', 'action' => 'edit', $detalleSabor['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'detalle_sabores', 'action' => 'delete', $detalleSabor['id']), null, __('Are you sure you want to delete # %s?', $detalleSabor['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Detalle Sabor'), array('controller' => 'detalle_sabores', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
