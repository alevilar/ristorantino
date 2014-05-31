<div class="ivaResponsabilidades view">
<h2><?php  __('IVA responsabilidad');?></h2>
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
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Editar IVA responsabilidad', true), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $html->link(__('Borrar IVA responsabilidad', true), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), null, sprintf(__('Esta seguro que desea borrar # %s?', true), $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $html->link(__('Listar IVA responsabilidad', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('Crear IVA responsabilidad', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
