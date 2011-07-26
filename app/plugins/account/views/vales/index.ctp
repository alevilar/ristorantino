<div class="vales index">
    <h2><?php __('Vales'); ?></h2>
    <p>
        <?php
        echo $paginator->counter(array(
            'format' => __('Mostrando %start% a %end% de %count% vales', true)
        ));
        ?></p>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $paginator->sort('persona'); ?></th>
            <th><?php echo $paginator->sort('monto'); ?></th>
            <th><?php echo $paginator->sort('created'); ?></th>
            <th class="actions"><?php __('Actions'); ?></th>
        </tr>
        <?php
        $i = 0;
        foreach ($vales as $vale):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
        ?>
            <tr<?php echo $class; ?>>
                <td>
                <?php echo $vale['Vale']['persona']; ?>
            </td>
            <td>
                <?php echo $vale['Vale']['monto']; ?>
            </td>
            <td>
                <?php echo date("d/m/Y H:i", strtotime($vale['Vale']['created'])); ?>
            </td>
            <td class="actions">
                <?php echo $html->link(__('Editar', true), array('action' => 'edit', $vale['Vale']['id'])); ?>
                <?php echo $html->link(__('Eliminar', true), array('action' => 'delete', $vale['Vale']['id']), null, sprintf(__('Seguro deseas eliminar el vale de %s a %s?', true), $vale['Vale']['monto'], $vale['Vale']['persona'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
            </table>
        </div>
<?
                if (@$paginator->numbers()) {
?>
                    <div class="paging">
    <?php echo $paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?> | <?php echo $paginator->numbers(); ?>	<?php echo $paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
                </div>
<?
                }
?>
                <div class="actions">
                    <ul>
                        <li><?php echo $html->link(__('Nuevo vale', true), array('action' => 'add')); ?></li>
    </ul>
</div>
