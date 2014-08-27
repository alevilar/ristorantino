<div class="mozos view">
<h2><?php echo __('Mozo');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($mesa['User']['nombre']." ".$mesa['User']['apellido'], array('controller'=> 'users', 'action'=>'view', $mesa['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Numero'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $mesa['Mozo']['numero']; ?>
			&nbsp;
		</dd>
	</dl>
</div>


