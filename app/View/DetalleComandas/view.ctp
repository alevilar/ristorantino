<div class="comandas view">
<h2><?php echo __('Comanda');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['DetalleComanda']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Producto Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['DetalleComanda']['producto_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Cant'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['DetalleComanda']['cant']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Mesa Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['DetalleComanda']['mesa_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comanda['DetalleComanda']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Comanda'), array('action'=>'edit', $comanda['DetalleComanda']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Comanda'), array('action'=>'delete', $comanda['DetalleComanda']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $comanda['DetalleComanda']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Comandas'), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comanda'), array('action'=>'add')); ?> </li>
	</ul>
</div>
