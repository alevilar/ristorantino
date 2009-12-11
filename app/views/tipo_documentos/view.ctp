<div class="tipoDocumentos view">
<h2><?php  __('TipoDocumento');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDocumento['TipoDocumento']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Codigo Fiscal'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDocumento['TipoDocumento']['codigo_fiscal']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tipoDocumento['TipoDocumento']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit TipoDocumento', true), array('action' => 'edit', $tipoDocumento['TipoDocumento']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete TipoDocumento', true), array('action' => 'delete', $tipoDocumento['TipoDocumento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoDocumento['TipoDocumento']['id'])); ?> </li>
		<li><?php echo $html->link(__('List TipoDocumentos', true), array('action' => 'index')); ?> </li>
		<li><?php echo $html->link(__('New TipoDocumento', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
