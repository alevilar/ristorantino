
<h1>Clientes</h1>


<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Crear Cliente'), array('action' => 'add')); ?></li>
    </ul>
</div>

<div class="clientes index">
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Página %page% de %pages%, mostrando %current% elementos de %count%')
        ));
        ?></p>

    <?php echo $this->Form->create("Cliente"); ?>
    <div class="ui-grid-d">
        <div class="ui-block-a">
            <?php echo $this->Form->input("id") ?>
            <?php echo $this->Form->input('nombre', array('placeholder' => 'Nombre del cliente', 'label' => false)); ?>
        </div>

        <div class="ui-block-b">
            <?php echo $this->Form->input('descuento_id', array('empty' => 'Descuento', 'label' => false)); ?>
        </div>
        
        <div class="ui-block-c">
            <?php echo $this->Form->input('iva_responsabilidad_id', array('empty' => 'Tipo IVA', 'label' => false)); ?>
        </div>

        <div class="ui-block-d">
            <?php echo $this->Form->input('nrodocumento', array('placeholder' => 'CUIT / CUIL / DNI', 'label' => false)); ?>
        </div>

        <div class="ui-block-e">
            <?php echo $this->Form->end("Buscar") ?>
        </div>
    </div>

    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?php echo $this->Paginator->sort('nombre'); ?></th>
            <th><?php echo $this->Paginator->sort('Descuento.name', 'Descuento'); ?></th>
            <th style="text-align: center;"><?php echo $this->Paginator->sort('IvaResponsabilidad.name', 'IVA'); ?></th>
            <th><?php echo $this->Paginator->sort('TipoDocumento.name', 'Tipo Documento'); ?></th>
            <th><?php echo $this->Paginator->sort('nrodocumento', 'Número'); ?></th>
            <th><?php echo $this->Paginator->sort('created', 'Creado'); ?></th>
            <th class="actions"><?php echo __('Acciones'); ?></th>
        </tr>
        <?php
        if ($this->Paginator->params['paging']['Cliente']['count'] != 0) {
            $i = 0;
            foreach ($clientes as $cliente):
                $class = null;
                if ($i++ % 2 == 0) {
                    $class = ' class="altrow"';
                }
                ?>
                <tr<?php echo $class; ?>>
                    <td>
                        <?php echo $cliente['Cliente']['nombre']; ?>
                    </td>
                    <td title="<?php echo $cliente['Descuento']['description'] . " (%" . $cliente['Descuento']['porcentaje'] . ")"; ?>">
                        <?php echo $cliente['Descuento']['name']; ?>
                    </td>
                    <td>
                        <?php echo ($cliente['IvaResponsabilidad']['name']); ?>
                    </td>

                    <td>
                        <?php
                        echo $cliente['TipoDocumento']['name'];
                        ?>
                    </td>
                    <td>
                        <?php
                        echo $cliente['Cliente']['nrodocumento'];
                        ?>
                    </td>
                    <td>
                        <?php echo date('d/m/Y H:i', strtotime($cliente['Cliente']['created'])); ?>
                    </td>
                    <td class="actions">
                        <?php echo $this->Html->link(__('Ver'), array('action' => 'view', $cliente['Cliente']['id'])); ?>
                        <?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $cliente['Cliente']['id'])); ?>
                        <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $cliente['Cliente']['id']), null, __('¿Está seguro que desea borrar el cliente: %s?', $cliente['Cliente']['nombre'])); ?>
                    </td>
                </tr>
                <?php
            endforeach;
        } else {
            echo('<td>No se encontraron clientes</td>');
        }
        ?>



    </table>

</div>
<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior'), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next(__('próximo') . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Crear Cliente'), array('action' => 'add')); ?></li>
    </ul>
</div>
