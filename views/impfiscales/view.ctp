<div class="impfiscales view">
<h2><?php  __('Impfiscal');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $impfiscal['Impfiscal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $impfiscal['Impfiscal']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $impfiscal['Impfiscal']['path']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Impfiscal', true), array('action'=>'edit', $impfiscal['Impfiscal']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Impfiscal', true), array('action'=>'delete', $impfiscal['Impfiscal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $impfiscal['Impfiscal']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Impfiscales', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Impfiscal', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
