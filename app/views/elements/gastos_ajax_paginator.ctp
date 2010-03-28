<table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo $paginator->sort('total');?></th>
            <th><?php echo $paginator->sort('name');?></th>
            <th><?php echo $paginator->sort('created');?></th>
            <th><?php echo $paginator->sort('modified');?></th>
            <th class="actions"><?php __('Actions');?></th>
    </tr>
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
                            $<?php echo $gasto['Egreso']['total']; ?>
                    </td>
                    <td>
                            <?php echo $gasto['Egreso']['name']; ?>
                    </td>

                    <td>
                            <?php echo $gasto['Egreso']['created']; ?>
                    </td>
                    <td>
                            <?php echo $gasto['Egreso']['modified']; ?>
                    </td>
                    <td class="actions">
                            <?php echo $html->link(__('View', true), array('action' => 'view', $gasto['Egreso']['id'])); ?>
                            <?php echo $html->link(__('Edit', true), array('action' => 'edit', $gasto['Egreso']['id'])); ?>
                            <?php echo $html->link(__('Delete', true), array('action' => 'delete', $gasto['Egreso']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $gasto['Egreso']['id'])); ?>
                    </td>
            </tr>
    <?php endforeach; ?>
    </table>