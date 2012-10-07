<div class="pagos view">
<h2><?php  __('Pago');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mesa Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['mesa_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tipo De Pago Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['tipo_de_pago_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Valor'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $pago['Pago']['valor']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Pago', true), array('action'=>'edit', $pago['Pago']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Pago', true), array('action'=>'delete', $pago['Pago']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $pago['Pago']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Pagos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Pago', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
