<div class="ivaResponsabilidades view">
<h2><?php echo __('IVA responsabilidad');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Codigo Fiscal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php echo __('Nombre'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Editar IVA responsabilidad'), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Borrar IVA responsabilidad'), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), null, sprintf(__('Esta seguro que desea borrar # %s?'), $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Listar IVA responsabilidad'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('Crear IVA responsabilidad'), array('action' => 'add')); ?> </li>
	</ul>
</div>
