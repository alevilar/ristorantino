     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="tipoImpuestos index">
<h2><?php __('Tipo de Impuestos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Página %page% de %pages%, mostrando %current% de %count% elementos', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Nombre','name');?></th>
	<th><?php echo $paginator->sort('porcentaje');?></th>
        <th><?php echo $paginator->sort('tiene_neto');?></th>
        <th><?php echo $paginator->sort('tiene_impuesto');?></th>
	<th class="actions"><?php __('Acciones');?></th>
</tr>
<?php
$i = 0;
foreach ($tipoImpuestos as $tipoImpuesto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tipoImpuesto['TipoImpuesto']['name']; ?>
		</td>
		<td>
			<?php echo $tipoImpuesto['TipoImpuesto']['porcentaje']; ?>
		</td>
                <td>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_neto']; ?>
		</td>
                <td>
			<?php echo $tipoImpuesto['TipoImpuesto']['tiene_impuesto']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $tipoImpuesto['TipoImpuesto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action' => 'delete', $tipoImpuesto['TipoImpuesto']['id']), null, sprintf(__('¿Esta seguro que desea eliminar el tipo de impuesto "%s"?', true), $tipoImpuesto['TipoImpuesto']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Crear Tipo de impuesto', true), array('action' => 'add')); ?></li>
	</ul>
</div>
