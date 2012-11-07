<div class="egresos view">
<h2><?php echo __('Egreso');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Importe'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['total']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $egreso['Egreso']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Edit Egreso'), array('action' => 'edit', $egreso['Egreso']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Egreso'), array('action' => 'delete', $egreso['Egreso']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $egreso['Egreso']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Egresos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Egreso'), array('action' => 'add')); ?> </li>
	</ul>
</div>
