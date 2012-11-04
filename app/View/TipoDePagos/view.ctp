<div class="tipoDePagos view">
<h2><?php  echo __('Tipo De Pago');?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($tipoDePago['TipoDePago']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($tipoDePago['TipoDePago']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($tipoDePago['TipoDePago']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Image Url'); ?></dt>
		<dd>
			<?php echo h($tipoDePago['TipoDePago']['image_url']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Tipo De Pago'), array('action' => 'edit', $tipoDePago['TipoDePago']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Tipo De Pago'), array('action' => 'delete', $tipoDePago['TipoDePago']['id']), null, __('Are you sure you want to delete # %s?', $tipoDePago['TipoDePago']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Tipo De Pagos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Tipo De Pago'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Pagos'), array('controller' => 'pagos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Pagos');?></h3>
	<?php if (!empty($tipoDePago['Pago'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Mesa Id'); ?></th>
		<th><?php echo __('Tipo De Pago Id'); ?></th>
		<th><?php echo __('Valor'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipoDePago['Pago'] as $pago): ?>
		<tr>
			<td><?php echo $pago['id'];?></td>
			<td><?php echo $pago['mesa_id'];?></td>
			<td><?php echo $pago['tipo_de_pago_id'];?></td>
			<td><?php echo $pago['valor'];?></td>
			<td><?php echo $pago['created'];?></td>
			<td><?php echo $pago['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'pagos', 'action' => 'view', $pago['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'pagos', 'action' => 'edit', $pago['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'pagos', 'action' => 'delete', $pago['id']), null, __('Are you sure you want to delete # %s?', $pago['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Pago'), array('controller' => 'pagos', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
