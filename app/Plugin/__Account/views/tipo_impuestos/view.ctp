<div class="tipoImpuestos view">
<h2><?php  __('TipoImpuesto');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoImpuesto['TipoImpuesto']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoImpuesto['TipoImpuesto']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Porcentaje'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoImpuesto['TipoImpuesto']['porcentaje']; ?>
			&nbsp;
		</dd>
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiene Neto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_neto']; ?>
			&nbsp;
		</dd>
                <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Tiene Impuesto'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_impuesto']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar TipoImpuesto', true), array('action' => 'edit', $tipoImpuesto['TipoImpuesto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar TipoImpuesto', true), array('action' => 'delete', $tipoImpuesto['TipoImpuesto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoImpuesto['TipoImpuesto']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar TipoImpuestos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear  Tipo de impuesto', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
