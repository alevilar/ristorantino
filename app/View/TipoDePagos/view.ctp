<div class="tipoDePagos view">
<h2><?php  __('TipoDePago');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDePago['TipoDePago']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDePago['TipoDePago']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDePago['TipoDePago']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit TipoDePago', true), array('action'=>'edit', $tipoDePago['TipoDePago']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete TipoDePago', true), array('action'=>'delete', $tipoDePago['TipoDePago']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoDePago['TipoDePago']['id'])); ?> </li>
		<li><?php echo $html->link(__('List TipoDePagos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New TipoDePago', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Pagos', true), array('controller'=> 'pagos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Pago', true), array('controller'=> 'pagos', 'action'=>'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php  __('Related Pagos');?></h3>
	<?php if (!empty($tipoDePago['Pago'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $tipoDePago['Pago']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mesa Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $tipoDePago['Pago']['mesa_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo De Pago Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $tipoDePago['Pago']['tipo_de_pago_id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $tipoDePago['Pago']['valor'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Pago', true), array('controller'=> 'pagos', 'action'=>'edit', $tipoDePago['Pago']['id'])); ?></li>
			</ul>
		</div>
	</div>
	<div class="related">
	<h3><?php __('Related Pagos');?></h3>
	<?php if (!empty($tipoDePago['Pago'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Mesa Id'); ?></th>
		<th><?php __('Tipo De Pago Id'); ?></th>
		<th><?php __('Valor'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($tipoDePago['Pago'] as $pago):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $pago['id'];?></td>
			<td><?php echo $pago['mesa_id'];?></td>
			<td><?php echo $pago['tipo_de_pago_id'];?></td>
			<td><?php echo $pago['valor'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'pagos', 'action'=>'view', $pago['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'pagos', 'action'=>'edit', $pago['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'pagos', 'action'=>'delete', $pago['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pago['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Pago', true), array('controller'=> 'pagos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
