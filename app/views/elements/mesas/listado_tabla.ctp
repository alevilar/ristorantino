<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('Mesa','numero');?></th>
	<th><?php echo $paginator->sort('Mozo (ID) Nº','mozo_id');?></th>
	<th><?php echo $paginator->sort('total');?></th>
        <th>Descuento</th>
        <th><?php echo $paginator->sort('Cubiertos','cant_comensales');?></th>
	<th>
        <?php echo $paginator->sort('Fecha Abrió','created');?><br />
        </th>
        <th>
        <?php echo $paginator->sort('Fecha Cerró','time_cerro');?><br />
        </th>
        <th>
        <?php echo $paginator->sort('Fecha Cobró','time_cobro');?><br />
        </th>
	<th>Tipo Factura</th>
        <th><?php echo $paginator->sort('Nombre Cliente','Cliente.nombre');?></th>


	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($mesas as $mesa):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $mesa['Mesa']['id']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['numero']; ?>
		</td>
		<td>
			<?php echo $html->link('('.$mesa['Mesa']['mozo_id'].') ','/Mozos/view/'.$mesa['Mesa']['mozo_id']) . 'N° '.$mesa['Mozo']['numero']; ?>
		</td>
		<td>
			<?php echo $mesa['Mesa']['total']; ?>
		</td>
                <td>
			<?php
			if(!empty($mesa['Cliente']['Descuento']['porcentaje'])){
			 	echo $mesa['Cliente']['Descuento']['porcentaje']."%"; }
			 else{
			 	echo '0%';
			 }
                             ?>
		</td>
                <td>
			<?php echo $mesa['Mesa']['cant_comensales'] ?>
		</td>
		<td>
			<?php
                        if ( $mesa['Mesa']['created'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mesa['Mesa']['created']));
                        } else {
                            echo "Mesa sin Abrir !!";
                        }
                        ?>
		</td>
                <td>
                    <?php
                        if ( $mesa['Mesa']['time_cerro'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mesa['Mesa']['time_cerro']));
                        } else {
                            echo "Mesa sin Cerrar";
                        }
                    ?>
		</td>
                <td>
                    <?php
                        if ( $mesa['Mesa']['time_cobro'] != '0000-00-00 00:00:00'){
                            echo date('d-m-y (H:i)',strtotime($mesa['Mesa']['time_cobro']));
                        } else {
                            echo "Mesa sin Cobrar";
                        }
                    ?>
		</td>
		<td>
			<?php
			if(!empty($mesa['Cliente']['Descuento']['porcentaje'])){
			 	echo 'remito'; }
			 elseif($mesa['Cliente']['tipofactura']) {
			 	echo 'factura "'.$mesa['Cliente']['tipofactura'].'"';
			 }
			 else echo 'factura "B"'?>
		</td>
                <td>
			<?php
			if(!empty($mesa['Cliente'])){
                            echo $mesa['Cliente']['nombre'];
                        }
                        ?>
		</td>

		<td class="actions">
			<?php echo $html->link(__('Reabrir', true), array('action'=>'reabrir', $mesa['Mesa']['id'])); ?>
                        <?php echo $html->link(__('View', true), array('action'=>'view', $mesa['Mesa']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $mesa['Mesa']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $mesa['Mesa']['id']), null, sprintf(__('Seguro que queres borrar la mesa # %s?\n Hacerlo significa borrarla de la base de datos y no sera computada.\nSe perderan la informacion estadisica de los pedidos\nrealidados para esta mesa.', true), $mesa['Mesa']['numero'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>