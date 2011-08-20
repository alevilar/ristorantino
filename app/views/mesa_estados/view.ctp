<div class="mesaEstados view">
<h2><?php  __('MesaEstado');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['parent_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['modified']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lft'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['lft']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Rght'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesaEstado['MesaEstado']['rght']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit MesaEstado', true), array('action' => 'edit', $mesaEstado['MesaEstado']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete MesaEstado', true), array('action' => 'delete', $mesaEstado['MesaEstado']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $mesaEstado['MesaEstado']['id'])); ?> </li>
		<li><?php echo $html->link(__('List MesaEstados', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New MesaEstado', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
