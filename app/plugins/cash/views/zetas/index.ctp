
<table>
    <thead>
        <tr>
            <th>Total Ventas</th>
            <th>#Comprobante</th>
            <th>Monto Iva</th>
            <th>Monto Neto</th>
            <th>Nota de Crédito IVA</th>
            <th>Nota de Crédito Neto</th>
            <th>Observación de las Tarjetas</th>
            <th>Observación del Zeta</th>
            <th>Creado</th>
            <th>Modificado</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($zetas as $z) {?>
        <tr>
            <td><?php echo $z['Zeta']['total_ventas']?></td>
            <td><?php echo $z['Zeta']['numero_comprobante']?></td>
            <td><?php echo $z['Zeta']['monto_iva']?></td>
            <td><?php echo $z['Zeta']['monto_neto']?></td>
            <td><?php echo $z['Zeta']['nota_credito_iva']?></td>
            <td><?php echo $z['Zeta']['nota_credito_neto']?></td>
            <td><?php echo $z['Zeta']['observacion_comprobante_tarjeta']?></td>
            <td><?php echo $z['Zeta']['observacion']?></td>
            <td><?php echo $z['Zeta']['created']?></td>
            <td><?php echo $z['Zeta']['modified']?></td>
            <td><?php echo $html->link('arqueo', array('controller'=>'arqueos', 'action'=>'edit', $z['Zeta']['arqueo_id']));?></td>
        </tr>
<?php } ?>
        </tbody>
</table>