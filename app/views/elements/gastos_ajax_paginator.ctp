<table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo $paginator->sort('importe');?></th>
            <th><?php echo $paginator->sort('name');?></th>
            <th><?php echo $paginator->sort('created');?></th>
            <th><?php echo $paginator->sort('modified');?></th>
            <th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($gastos as $gasto):
            $class = null;
            if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
            }
    ?>
            <tr<?php echo $class;?>>
                     <td>
                            $<?php echo $gasto['Gasto']['importe']; ?>
                    </td>
                    <td>
                            <?php echo $gasto['Gasto']['name']; ?>
                    </td>

                    <td>
                            <?php echo $gasto['Gasto']['created']; ?>
                    </td>
                    <td>
                            <?php echo $gasto['Gasto']['modified']; ?>
                    </td>
                    <td class="actions">
                            <?php echo $html->link(__('View', true), array('action' => 'view', $gasto['Gasto']['id'])); ?>
                            <?php echo $html->link(__('Edit', true), array('action' => 'edit', $gasto['Gasto']['id'])); ?>
                            <?php echo $html->link(__('Delete', true), array('action' => 'delete', $gasto['Gasto']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gasto['Gasto']['id'])); ?>
                    </td>
            </tr>
    <?php endforeach; ?>
    </table>