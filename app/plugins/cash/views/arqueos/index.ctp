<h1>Listado de Arqueos</h1>


<?php echo $html->link('Nuevo Arqueo', array(
    'plugin' => 'cash',
    'controller' => 'arqueos',
    'action' => 'add',
)) ?>
<table>
    <tr>
        <th>Caja</th>
        <th>Fecha</th>
        <th>Saldo</th>
        <th>Importe Inicial</th>
        <th>Ingreso</th>
        <th>Otros Ingresos</th>
        <th>Egreso</th>
        <th>Otros Egresos</th>
        <th>Importe Final</th>
        <th>Creado</th>
        <th>Modificado</th>
        <th></th>
    </tr>
<?php foreach ($arqueos as $arq) { ?>
    <tr>
        <td><?php echo $arq['Caja']['name'] ?></td>
        <td><?php echo date('d/m/Y', strtotime($arq['Arqueo']['datetime'])) ?></td>
        <td><?php echo $arq['Arqueo']['saldo'] ?></td>
        <td><?php echo $arq['Arqueo']['importe_inicial'] ?></td>
        <td><?php echo $arq['Arqueo']['ingreso'] ?></td>
        <td><?php echo $arq['Arqueo']['otros_ingresos'] ?></td>
        <td><?php echo $arq['Arqueo']['egreso'] ?></td>
        <td><?php echo $arq['Arqueo']['otros_egresos'] ?></td>
        <td><?php echo $arq['Arqueo']['importe_final'] ?></td>
        <td><?php echo date('d/m/Y H:i:s', strtotime($arq['Arqueo']['created'])) ?></td>
        <td><?php echo date('d/m/Y H:i:s', strtotime($arq['Arqueo']['modified'])) ?></td>
        <td><?php echo $html->link('Editar', 'edit/'.$arq['Arqueo']['id']);?></td>
    </tr>

<?php } ?>
</table>