<div class="gastos view">
<h2><?php  __('Gasto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gasto['Gasto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gasto['Gasto']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Importe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gasto['Gasto']['importe']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gasto['Gasto']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $gasto['Gasto']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Gasto', true), array('action' => 'edit', $gasto['Gasto']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Gasto', true), array('action' => 'delete', $gasto['Gasto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gasto['Gasto']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Gastos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Gasto', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
