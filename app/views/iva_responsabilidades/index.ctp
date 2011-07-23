<div class="ivaResponsabilidades index">
<h2><?php __('IVA responsabilidad');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% de %count%', true)
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
foreach ($ivaResponsabilidades as $ivaResponsabilidad):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['id']; ?>
		</td>
		<td>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']; ?>
		</td>
		<td>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Ver', true), array('action' => 'view', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), null, sprintf(__('Esta seguro que desea borrar # %s?', true), $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
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
		<li><?php echo $html->link(__('Crear IVA responsabilidad', true), array('action' => 'add')); ?></li>
	</ul>
</div>
