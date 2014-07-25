<div class="descuentos view">
<h2><?php  __('Descuento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Porcentaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['porcentaje']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $descuento['Descuento']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar Descuento', true), array('action'=>'edit', $descuento['Descuento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar Descuento', true), array('action'=>'delete', $descuento['Descuento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $descuento['Descuento']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar Descuentos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear Descuento', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
