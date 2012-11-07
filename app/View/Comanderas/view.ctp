<div class="comanderas view">
<h2><?php  echo __('Comandera');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Driver Name'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['driver_name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Path'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['path']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imprime Ticket'); ?></dt>
		<dd>
			<?php echo h($comandera['Comandera']['imprime_ticket']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comandera'), array('action' => 'edit', $comandera['Comandera']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comandera'), array('action' => 'delete', $comandera['Comandera']['id']), null, __('Are you sure you want to delete # %s?', $comandera['Comandera']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comanderas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comandera'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Productos'), array('controller' => 'productos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Producto'), array('controller' => 'productos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Productos');?></h3>
	<?php if (!empty($comandera['Producto'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Abrev'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Categoria Id'); ?></th>
		<th><?php echo __('Precio'); ?></th>
		<th><?php echo __('Comandera Id'); ?></th>
		<th><?php echo __('Order'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Deleted Date'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($comandera['Producto'] as $producto): ?>
		<tr>
			<td><?php echo $producto['id'];?></td>
			<td><?php echo $producto['name'];?></td>
			<td><?php echo $producto['abrev'];?></td>
			<td><?php echo $producto['description'];?></td>
			<td><?php echo $producto['categoria_id'];?></td>
			<td><?php echo $producto['precio'];?></td>
			<td><?php echo $producto['comandera_id'];?></td>
			<td><?php echo $producto['order'];?></td>
			<td><?php echo $producto['created'];?></td>
			<td><?php echo $producto['modified'];?></td>
			<td><?php echo $producto['deleted_date'];?></td>
			<td><?php echo $producto['deleted'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'productos', 'action' => 'view', $producto['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'productos', 'action' => 'edit', $producto['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'productos', 'action' => 'delete', $producto['id']), null, __('Are you sure you want to delete # %s?', $producto['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Producto'), array('controller' => 'productos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
