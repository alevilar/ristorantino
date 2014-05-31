<table cellpadding="0" cellspacing="0">
    <?php
    $i = 0;

    foreach ($egresos as $gasto):
        $class = null;
        if ($i++ % 2 == 0) {
            $class = ' class="altrow"';
        }
        ?>
    <tr<?php echo $class;?>>
        <td>
            $<?php echo $gasto['Egreso']['total']+$gasto['Egreso']['iibb']+$gasto['Egreso']['otros']+$gasto['Egreso']['iva']; ?>
        </td>
        <td>
                <?php echo $gasto['Egreso']['name']; ?>
        </td>
         <td>
                <?php echo $gasto['User']['nombre']." ".$gasto['User']['apellido']; ?>
        </td>
        <td>
                <?php echo $gasto['Egreso']['created']; ?>
        </td>

        <td class="actions">
                <?php echo $html->link(__('Edit', true), array('action' => 'edit', $gasto['Egreso']['id'])); ?>
                <?php echo $html->link(__('Delete', true), array('action' => 'delete', $gasto['Egreso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gasto['Egreso']['id'])); ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>