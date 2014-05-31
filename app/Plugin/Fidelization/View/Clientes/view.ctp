<div class="clientes view">
<h2><?php echo __('Cliente'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['codigo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mail'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['mail']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Descuento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cliente['Descuento']['name'], array('controller' => 'descuentos', 'action' => 'view', $cliente['Descuento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipofactura'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['tipofactura']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nrodocumento'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['nrodocumento']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Tipo Documento'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cliente['TipoDocumento']['name'], array('controller' => 'tipo_documentos', 'action' => 'view', $cliente['TipoDocumento']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domicilio'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['domicilio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Responsabilidad Iva'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['responsabilidad_iva']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Iva Responsabilidad'); ?></dt>
		<dd>
			<?php echo $this->Html->link($cliente['IvaResponsabilidad']['name'], array('controller' => 'iva_responsabilidades', 'action' => 'view', $cliente['IvaResponsabilidad']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($cliente['Cliente']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Cliente'), array('action' => 'edit', $cliente['Cliente']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Cliente'), array('action' => 'delete', $cliente['Cliente']['id']), null, __('Are you sure you want to delete # %s?', $cliente['Cliente']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Clientes'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Cliente'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Descuentos'), array('controller' => 'descuentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Descuento'), array('controller' => 'descuentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo Documentos'), array('controller' => 'tipo_documentos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo Documento'), array('controller' => 'tipo_documentos', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Iva Responsabilidades'), array('controller' => 'iva_responsabilidades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Iva Responsabilidad'), array('controller' => 'iva_responsabilidades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Mesas'), array('controller' => 'mesas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Mesas'); ?></h3>
	<?php if (!empty($cliente['Mesa'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Numero'); ?></th>
		<th><?php echo __('Mozo Id'); ?></th>
		<th><?php echo __('Subtotal'); ?></th>
		<th><?php echo __('Total'); ?></th>
		<th><?php echo __('Cliente Id'); ?></th>
		<th><?php echo __('Menu'); ?></th>
		<th><?php echo __('Cant Comensales'); ?></th>
		<th><?php echo __('Estado Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Time Cerro'); ?></th>
		<th><?php echo __('Time Cobro'); ?></th>
		<th><?php echo __('Deleted Date'); ?></th>
		<th><?php echo __('Deleted'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($cliente['Mesa'] as $mesa): ?>
		<tr>
			<td><?php echo $mesa['id']; ?></td>
			<td><?php echo $mesa['numero']; ?></td>
			<td><?php echo $mesa['mozo_id']; ?></td>
			<td><?php echo $mesa['subtotal']; ?></td>
			<td><?php echo $mesa['total']; ?></td>
			<td><?php echo $mesa['cliente_id']; ?></td>
			<td><?php echo $mesa['menu']; ?></td>
			<td><?php echo $mesa['cant_comensales']; ?></td>
			<td><?php echo $mesa['estado_id']; ?></td>
			<td><?php echo $mesa['created']; ?></td>
			<td><?php echo $mesa['modified']; ?></td>
			<td><?php echo $mesa['time_cerro']; ?></td>
			<td><?php echo $mesa['time_cobro']; ?></td>
			<td><?php echo $mesa['deleted_date']; ?></td>
			<td><?php echo $mesa['deleted']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'mesas', 'action' => 'view', $mesa['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'mesas', 'action' => 'edit', $mesa['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'mesas', 'action' => 'delete', $mesa['id']), null, __('Are you sure you want to delete # %s?', $mesa['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Mesa'), array('controller' => 'mesas', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
