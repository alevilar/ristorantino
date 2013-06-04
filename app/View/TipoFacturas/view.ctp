<div class="tipoFacturas view">
<h2><?php  echo __('Tipo Factura');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tipoFactura['TipoFactura']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tipoFactura['TipoFactura']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codename'); ?></dt>
		<dd>
			<?php echo h($tipoFactura['TipoFactura']['codename']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($tipoFactura['TipoFactura']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($tipoFactura['TipoFactura']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipo Factura'), array('action' => 'edit', $tipoFactura['TipoFactura']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tipo Factura'), array('action' => 'delete', $tipoFactura['TipoFactura']['id']), null, __('Are you sure you want to delete # %s?', $tipoFactura['TipoFactura']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Factura'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('controller' => 'iva_responsabilidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('controller' => 'iva_responsabilidades', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Iva Responsabilidades');?></h3>
	<?php if (!empty($tipoFactura['IvaResponsabilidad'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Codigo Fiscal'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Tipo Factura Id'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipoFactura['IvaResponsabilidad'] as $ivaResponsabilidad): ?>
		<tr>
			<td><?php echo $ivaResponsabilidad['id'];?></td>
			<td><?php echo $ivaResponsabilidad['codigo_fiscal'];?></td>
			<td><?php echo $ivaResponsabilidad['name'];?></td>
			<td><?php echo $ivaResponsabilidad['tipo_factura_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'iva_responsabilidades', 'action' => 'view', $ivaResponsabilidad['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'iva_responsabilidades', 'action' => 'edit', $ivaResponsabilidad['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'iva_responsabilidades', 'action' => 'delete', $ivaResponsabilidad['id']), null, __('Are you sure you want to delete # %s?', $ivaResponsabilidad['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('controller' => 'iva_responsabilidades', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
