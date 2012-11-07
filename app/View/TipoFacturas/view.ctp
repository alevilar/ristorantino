<div class="tipoFacturas view">
<h2><?php echo __('TipoFactura');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoFactura['TipoFactura']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoFactura['TipoFactura']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoFactura['TipoFactura']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoFactura['TipoFactura']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit TipoFactura'), array('action' => 'edit', $tipoFactura['TipoFactura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete TipoFactura'), array('action' => 'delete', $tipoFactura['TipoFactura']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $tipoFactura['TipoFactura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List TipoFacturas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New TipoFactura'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Egresos'), array('controller' => 'egresos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Egresos');?></h3>
	<?php if (!empty($tipoFactura['Egreso'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Tipo Factura Id'); ?></th>
		<th><?php echo __('Iva'); ?></th>
		<th><?php echo __('Iibb'); ?></th>
		<th><?php echo __('Otros'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipoFactura['Egreso'] as $egreso):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $egreso['id'];?></td>
			<td><?php echo $egreso['name'];?></td>
			<td><?php echo $egreso['tipo_factura_id'];?></td>
			<td><?php echo $egreso['iva'];?></td>
			<td><?php echo $egreso['iibb'];?></td>
			<td><?php echo $egreso['otros'];?></td>
			<td><?php echo $egreso['total'];?></td>
			<td><?php echo $egreso['created'];?></td>
			<td><?php echo $egreso['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'egresos', 'action' => 'view', $egreso['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'egresos', 'action' => 'edit', $egreso['id'])); ?>
				<?php echo $this->Html->link(__('Delete'), array('controller' => 'egresos', 'action' => 'delete', $egreso['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $egreso['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Egreso'), array('controller' => 'egresos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
