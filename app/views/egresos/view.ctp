<div class="egresos view">
<h2><?php  __('Egreso');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Importe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Egreso', true), array('action' => 'edit', $egreso['Egreso']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Egreso', true), array('action' => 'delete', $egreso['Egreso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $egreso['Egreso']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Egresos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New Egreso', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
