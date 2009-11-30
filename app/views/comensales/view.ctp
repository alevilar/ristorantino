<div class="comensales view">
<h2><?php  __('Comensal');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comensal['Comensal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Mayores'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comensal['Comensal']['cant_mayores']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Menores'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comensal['Comensal']['cant_menores']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Cant Bebes'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $comensal['Comensal']['cant_bebes']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Mesa'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($comensal['Mesa']['id'], array('controller'=> 'mesas', 'action'=>'view', $comensal['Mesa']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Comensal', true), array('action'=>'edit', $comensal['Comensal']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Comensal', true), array('action'=>'delete', $comensal['Comensal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $comensal['Comensal']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Comensales', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Comensal', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Mesas', true), array('controller'=> 'mesas', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Mesa', true), array('controller'=> 'mesas', 'action'=>'add')); ?> </li>
	</ul>
</div>
