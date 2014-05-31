<div class="comanderas view">
<h2><?php  __('Comandera');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comandera['Comandera']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comandera['Comandera']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comandera['Comandera']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comandera['Comandera']['path']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imprime Ticket'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comandera['Comandera']['imprime_ticket']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Comandera', true), array('action'=>'edit', $comandera['Comandera']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Comandera', true), array('action'=>'delete', $comandera['Comandera']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comandera['Comandera']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Comanderas', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comandera', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
