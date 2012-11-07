<div class="sabores view">
<h2><?php echo __('Sabor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Categoria Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['categoria_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sabor['Sabor']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Sabor'), array('action'=>'edit', $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar Sabor'), array('action'=>'delete', $sabor['Sabor']['id']), null, sprintf(__('Are you sure you want to delete # %s?'), $sabor['Sabor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Sabores'), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Sabor'), array('action'=>'add')); ?> </li>
	</ul>
</div>
