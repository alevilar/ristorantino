
<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Cant. Arqueos</th>
            <th>Computa Ingresos</th>
            <th>Computa Egresos</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cajas as $c) { ?>
            <tr>
                <td><?php echo $c['Caja']['id'] ?></td>
                <td><?php echo $c['Caja']['name'] ?></td>
                <td><?php echo $c['Caja']['cant_arqueos'] ?></td>
                <td><?php echo empty($c['Caja']['computa_ingresos']) ? 'no' : 'si'; ?></td>
                <td><?php echo empty($c['Caja']['computa_egresos']) ? 'no' : 'si'; ?></td>
                <td><?php echo $html->link('nuevo arqueo', array('controller' => 'arqueos', 'action' => 'add', $c['Caja']['id'])) ?></td>
                <td><?php echo $html->link('editar', 'edit/' . $c['Caja']['id']) ?></td>
                <td><?php echo $html->link(__('Borrar', true), array('action' => 'delete', $c['Caja']['id']), null, sprintf(__('¿Está seguro que desea borrar la caja: %s?', true), $c['Caja']['name'])); ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>


<?php echo $html->link("Nueva Caja", 'add'); ?>
