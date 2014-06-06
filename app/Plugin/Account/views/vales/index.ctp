     <?php  
        echo $this->element('menuadmin');
     ?>
<div class="vales index">
    <h2><?php __('Vales'); ?></h2>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Mostrando %start% a %end% de %count% vales', true)
        ));
        ?></p>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('Usuario', 'User.username'); ?></th>
            <th><?php echo $this->Paginator->sort('persona'); ?></th>
            <th><?php echo $this->Paginator->sort('fecha'); ?></th>
            <th><?php echo $this->Paginator->sort('monto'); ?></th>
            <th><?php echo $this->Paginator->sort('Creado','created'); ?></th>
            <th class="actions"><?php __('Acciones'); ?></th>
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
                <?php if (!empty($vale['User']['username'])) echo $vale['User']['username']; ?>
            </td>
            <td>
                <?php echo $vale['Vale']['persona']; ?>
            </td>
            <td>
                <?php echo date("d/m/Y", strtotime($vale['Vale']['fecha'])); ?>
            </td>
            <td>
                <?php echo $vale['Vale']['monto']; ?>
            </td>
            <td>
                <?php echo date("d/m/Y H:i", strtotime($vale['Vale']['created'])); ?>
            </td>
            <td class="actions">
                <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit', $vale['Vale']['id'])); ?>
                <?php echo $this->Html->link(__('Eliminar', true), array('action' => 'delete', $vale['Vale']['id']), null, sprintf(__('¿Estas seguro que deseas eliminar el vale de %s a "%s"?', true), $vale['Vale']['monto'], $vale['Vale']['persona'])); ?>
            </td>
        </tr>
        <?php endforeach; ?>
            </table>
        </div>
<?
                if (@$this->Paginator->numbers()) {
?>
                    <div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?> | <?php echo $this->Paginator->numbers(); ?>	<?php echo $this->Paginator->next(__('siguiente', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
                </div>
<?
                }
?>
                <div class="actions">
                    <ul>
                        <li><?php echo $this->Html->link(__('Nuevo vale', true), array('action' => 'add')); ?></li>
    </ul>
</div>
