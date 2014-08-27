

<div class="tipoImpuestos index">
<h2><?php __('Tipo de Impuestos');?></h2>
<p>
<?php
echo $this->Paginator->counter(array(
	'format' => __('Página {:page} de {:pages}, mostrando {:current} de {:count} elementos')
));
?></p>
<table class="table">
<tr>
	<th><?php echo $this->Paginator->sort('Nombre','name');?></th>
	<th><?php echo $this->Paginator->sort('porcentaje');?></th>
        <th><?php echo $this->Paginator->sort('tiene_neto');?></th>
        <th><?php echo $this->Paginator->sort('tiene_impuesto');?></th>
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
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $tipoImpuesto['TipoImpuesto']['id'])); ?>
			<?php echo $this->Html->link(__('Borrar'), array('action' => 'delete', $tipoImpuesto['TipoImpuesto']['id']), null, sprintf(__('¿Esta seguro que desea eliminar el tipo de impuesto "%s"?'), $tipoImpuesto['TipoImpuesto']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $this->Paginator->prev('<< '.__('previous'), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $this->Paginator->numbers();?>
	<?php echo $this->Paginator->next(__('next').' >>', array(), null, array('class' => 'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $this->Html->link(__('Crear Tipo de impuesto'), array('action' => 'add')); ?></li>
	</ul>
</div>
