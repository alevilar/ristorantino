<div class="ivaResponsabilidades index">
<h2><?php __('IVA responsabilidad');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% de %count%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $this->Paginator->sort('codigo_fiscal');?></th>
	<th><?php echo $this->Paginator->sort('Nombre');?></th>
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
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['codigo_fiscal']; ?>
		</td>
		<td>
			<?php echo $ivaResponsabilidad['IvaResponsabilidad']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar', true), array('action' => 'delete', $ivaResponsabilidad['IvaResponsabilidad']['id']), null, sprintf(__('Esta seguro que desea borrar # %s?', true), $ivaResponsabilidad['IvaResponsabilidad']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('próximo', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear IVA responsabilidad', true), array('action' => 'add')); ?></li>
	</ul>
</div>
