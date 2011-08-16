     <?php  
        echo $this->element('menuadmin');
     ?>

<div class="gastos index">
<h2><?php __('Gastos');?></h2>
<p>
<?php
        echo $paginator->counter(array(
            'format' => __('Mostrando %start% a %end% de %count% gastos', true)
        ));
        ?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('Proveedor', 'Proveedor.name');?></th>
	<th><?php echo $paginator->sort('clasificacion');?></th>
	<th><?php echo $paginator->sort('Tipo factura', 'TipoFactura.name');?></th>
	<th><?php echo $paginator->sort('factura_nro');?></th>
	<th><?php echo $paginator->sort('factura_fecha');?></th>
	<th><?php echo $paginator->sort('importe_neto');?></th>
        <th>Total</th>
	<th><?php echo $paginator->sort('Creado','created');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($gastos as $gasto):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
        
        $total = 0;
        if (!empty($gasto['Gasto']['importe_neto'])) {
            $total = $gasto['Gasto']['importe_neto'];
        }
        
        if (!empty($gasto['TipoImpuesto'])) {
            foreach($gasto['TipoImpuesto'] as $tipoImpuesto) {
                $total += $gasto['Gasto']['importe_neto'] * $tipoImpuesto['porcentaje'] / 100;
            }
        }
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $gasto['Proveedor']['name']; ?>
		</td>
		<td>
			<?php echo $gasto['Gasto']['clasificacion']; ?>
		</td>
		<td>
			<?php echo $gasto['TipoFactura']['name']; ?>
		</td>
		<td>
			<?php echo $gasto['Gasto']['factura_nro']; ?>
		</td>
		<td>
                        <?php echo date("d/m/Y H:i", strtotime($gasto['Gasto']['factura_fecha'])); ?>
		</td>
		<td>
			$ <?php echo $gasto['Gasto']['importe_neto']; ?>
		</td>
                <td>
			$ <?php echo $total; ?>
		</td>
		<td>
			<?php echo date("d/m/Y H:i", strtotime($gasto['Gasto']['created'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Editar', true), array('action' => 'edit', $gasto['Gasto']['id'])); ?>
			<?php echo $html->link(__('Borrar', true), array('action' => 'delete', $gasto['Gasto']['id']), null, sprintf(__('¿Esta seguro que desea eliminar "%s"?', true), $gasto['Gasto']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<?
if (@$paginator->numbers()) {
?>
    <div class="paging">
    <?php echo $paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?> | 
    <?php echo $paginator->numbers(); ?>	
    <?php echo $paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
<?
}
?>
<div class="actions">
    <ul>
        <li><?php echo $html->link(__('Nuevo gasto', true), array('action' => 'add')); ?></li>
    </ul>
</div>
