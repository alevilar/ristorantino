<div class="tipoDocumentos index">
<h2><?php __('Tipos de Documentos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('codigo_fiscal');?></th>
	<th><?php echo $paginator->sort('Nombre');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($tipoDocumentos as $tipoDocumento):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tipoDocumento['TipoDocumento']['id']; ?>
		</td>
		<td>
			<?php echo $tipoDocumento['TipoDocumento']['codigo_fiscal']; ?>
		</td>
		<td>
			<?php echo $tipoDocumento['TipoDocumento']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'view', $tipoDocumento['TipoDocumento']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $tipoDocumento['TipoDocumento']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action' => 'delete', $tipoDocumento['TipoDocumento']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tipoDocumento['TipoDocumento']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Crear nuevo Tipo de documento', true), array('action' => 'add')); ?></li>
	</ul>
</div>
