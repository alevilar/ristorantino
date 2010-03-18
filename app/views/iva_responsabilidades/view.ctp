<div class="ivaResponsabilidades view">
<h2><?php  __('IvaResponsabilidad');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo Fiscal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit IvaResponsabilidad', true), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete IvaResponsabilidad', true), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $html->link(__('List IvaResponsabilidades', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New IvaResponsabilidad', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
