<div class="clientes index">
	<h2><?php echo __('Clientes'); ?></h2>
	<table class="table">
            
            <thead>
                <?php echo $this->Form->create('') ?>
                <tr>
                        <th><?php echo $this->Form->text('codigo'); ?></th>
                        <th><?php echo $this->Form->text('mail'); ?></th>
                        <th><?php echo $this->Form->text('telefono'); ?></th>
                        <th><?php echo $this->Form->text('descuento_id'); ?></th>
                        <th><?php echo $this->Form->text('tipofactura'); ?></th>
                        <th><?php echo $this->Form->text('nombre'); ?></th>
                        <th><?php echo $this->Form->text('nrodocumento'); ?></th>
                        <th><?php echo $this->Form->sekect('tipo_documento_id'); ?></th>
                        <th><?php echo $this->Form->text('domicilio'); ?></th>
                        <th><?php echo $this->Form->text('responsabilidad_iva'); ?></th>
                        <th><?php echo $this->Form->text('iva_responsabilidad_id'); ?></th>
                        <th><?php echo $this->Form->text('created'); ?></th>
                        <th><?php echo $this->Form->text('modified'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>


                <tr>
                                <th><?php echo $this->Paginator->sort('codigo'); ?></th>
                                <th><?php echo $this->Paginator->sort('mail'); ?></th>
                                <th><?php echo $this->Paginator->sort('telefono'); ?></th>
                                <th><?php echo $this->Paginator->sort('descuento_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('tipofactura'); ?></th>
                                <th><?php echo $this->Paginator->sort('nombre'); ?></th>
                                <th><?php echo $this->Paginator->sort('nrodocumento'); ?></th>
                                <th><?php echo $this->Paginator->sort('tipo_documento_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('domicilio'); ?></th>
                                <th><?php echo $this->Paginator->sort('responsabilidad_iva'); ?></th>
                                <th><?php echo $this->Paginator->sort('iva_responsabilidad_id'); ?></th>
                                <th><?php echo $this->Paginator->sort('created'); ?></th>
                                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                                <th class="actions"><?php echo __('Actions'); ?></th>
                </tr>
            </thead> 
	<?php foreach ($clientes as $cliente): ?>
	<tr>
		<td><?php echo h($cliente['Cliente']['codigo']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['mail']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['telefono']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cliente['Descuento']['name'], array('controller' => 'descuentos', 'action' => 'view', $cliente['Descuento']['id'])); ?>
		</td>
		<td><?php echo h($cliente['Cliente']['tipofactura']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['nombre']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['nrodocumento']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cliente['TipoDocumento']['name'], array('controller' => 'tipo_documentos', 'action' => 'view', $cliente['TipoDocumento']['id'])); ?>
		</td>
		<td><?php echo h($cliente['Cliente']['domicilio']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['responsabilidad_iva']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($cliente['IvaResponsabilidad']['name'], array('controller' => 'iva_responsabilidades', 'action' => 'view', $cliente['IvaResponsabilidad']['id'])); ?>
		</td>
		<td><?php echo h($cliente['Cliente']['created']); ?>&nbsp;</td>
		<td><?php echo h($cliente['Cliente']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $cliente['Cliente']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cliente['Cliente']['id']), array(), __('Are you sure you want to delete # %s?', $cliente['Cliente']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Cliente'), array('action' => 'add')); ?></li>
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
