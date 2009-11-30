<div class="categorias view">
<h2><?php  __('Categoria');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['parent_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Left'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['left']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Right'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['right']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $categoria['Categoria']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Categoria', true), array('action'=>'edit', $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Categoria', true), array('action'=>'delete', $categoria['Categoria']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $categoria['Categoria']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Categorias', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Categoria', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Items', true), array('controller'=> 'items', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Item', true), array('controller'=> 'items', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Items');?></h3>
	<?php if (!empty($categoria['Item'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Abrev'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Categoria Id'); ?></th>
		<th><?php __('Precio'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($categoria['Item'] as $item):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $item['id'];?></td>
			<td><?php echo $item['name'];?></td>
			<td><?php echo $item['abrev'];?></td>
			<td><?php echo $item['description'];?></td>
			<td><?php echo $item['categoria_id'];?></td>
			<td><?php echo $item['precio'];?></td>
			<td><?php echo $item['created'];?></td>
			<td><?php echo $item['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'items', 'action'=>'view', $item['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'items', 'action'=>'edit', $item['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'items', 'action'=>'delete', $item['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $item['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Item', true), array('controller'=> 'items', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
