<div class="comandas view">
<h2><?php  __('Comanda');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Producto Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['producto_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['cant']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mesa Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['Comanda']['mesa_id']; ?>
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
	</ul>
</div>
