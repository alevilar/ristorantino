<div class="comandas view">
<h2><?php  __('Comanda');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Prioridad'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['prioridad']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Impresa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['impresa']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Comanda', true), array('action'=>'edit', $comanda['Comanda']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Comanda', true), array('action'=>'delete', $comanda['Comanda']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comanda['Comanda']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Comandas', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comanda', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Detalle Comandas', true), array('controller'=> 'detalle_comandas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Detalle Comanda', true), array('controller'=> 'detalle_comandas', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Detalle Comandas');?></h3>
	<?php if (!empty($comanda['DetalleComanda'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Producto Id'); ?></th>
		<th><?php __('Cant'); ?></th>
		<th><?php __('Mesa Id'); ?></th>
		<th><?php __('Comanda Id'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($comanda['DetalleComanda'] as $detalleComanda):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $detalleComanda['id'];?></td>
			<td><?php echo $detalleComanda['producto_id'];?></td>
			<td><?php echo $detalleComanda['cant'];?></td>
			<td><?php echo $detalleComanda['mesa_id'];?></td>
			<td><?php echo $detalleComanda['comanda_id'];?></td>
			<td><?php echo $detalleComanda['created'];?></td>
			<td><?php echo $detalleComanda['modified'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'detalle_comandas', 'action'=>'view', $detalleComanda['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'detalle_comandas', 'action'=>'edit', $detalleComanda['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'detalle_comandas', 'action'=>'delete', $detalleComanda['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $detalleComanda['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Detalle Comanda', true), array('controller'=> 'detalle_comandas', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
