<div class="ivaResponsabilidades view">
<h2><?php echo __('Iva Responsabilidad'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ivaResponsabilidad['IvaResponsabilidad']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo Fiscal'); ?></dt>
		<dd>
			<?php echo h($ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($ivaResponsabilidad['IvaResponsabilidad']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo Factura'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ivaResponsabilidad['TipoFactura']['name'], array('controller' => 'tipo_facturas', 'action' => 'view', $ivaResponsabilidad['TipoFactura']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Iva Responsabilidad'), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Iva Responsabilidad'), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), array(), __('Are you sure you want to delete # %s?', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Facturas'), array('controller' => 'tipo_facturas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Factura'), array('controller' => 'tipo_facturas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('controller' => 'clientes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Clientes'); ?></h3>
	<?php if (!empty($ivaResponsabilidad['Cliente'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Codigo'); ?></th>
		<th><?php echo __('Mail'); ?></th>
		<th><?php echo __('Telefono'); ?></th>
		<th><?php echo __('Descuento Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th><?php echo __('Nrodocumento'); ?></th>
		<th><?php echo __('Tipo Documento Id'); ?></th>
		<th><?php echo __('Domicilio'); ?></th>
		<th><?php echo __('Iva Responsabilidad Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ivaResponsabilidad['Cliente'] as $cliente): ?>
		<tr>
			<td><?php echo $cliente['id']; ?></td>
			<td><?php echo $cliente['codigo']; ?></td>
			<td><?php echo $cliente['mail']; ?></td>
			<td><?php echo $cliente['telefono']; ?></td>
			<td><?php echo $cliente['descuento_id']; ?></td>
			<td><?php echo $cliente['nombre']; ?></td>
			<td><?php echo $cliente['nrodocumento']; ?></td>
			<td><?php echo $cliente['tipo_documento_id']; ?></td>
			<td><?php echo $cliente['domicilio']; ?></td>
			<td><?php echo $cliente['iva_responsabilidad_id']; ?></td>
			<td><?php echo $cliente['created']; ?></td>
			<td><?php echo $cliente['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'clientes', 'action' => 'view', $cliente['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'clientes', 'action' => 'edit', $cliente['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'clientes', 'action' => 'delete', $cliente['id']), array(), __('Are you sure you want to delete # %s?', $cliente['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Cliente'), array('controller' => 'clientes', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
