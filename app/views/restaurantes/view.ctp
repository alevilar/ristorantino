<div class="restaurantes view">
<h2><?php  __('Restaurante');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurante['Restaurante']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $restaurante['Restaurante']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Restaurante', true), array('action'=>'edit', $restaurante['Restaurante']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Restaurante', true), array('action'=>'delete', $restaurante['Restaurante']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $restaurante['Restaurante']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Restaurantes', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Restaurante', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
