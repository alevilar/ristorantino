<?php
echo $this->Html->link('mesas/index_head', false);
?>


<div id="mesas-index">
    <?php echo $this->Form->create("Mesa"); ?>
    <div class="ui-grid-d">
        <h2><?php __('Buscador de Mesas'); ?></h2>

        <div class="ui-block-a">
            <strong>Mesa y Mozo</strong>
            <?php echo $this->Form->input('Mesa.numero', array('label' => 'N°Mesa')); ?>
            <?php echo $this->Form->input('mozo_numero', array('label' => 'N°Mozo')); ?>
        </div>
        <div class="ui-block-b">
            <strong>Mesa Detalle</strong>
            <?php echo $this->Form->input('Mesa.total', array('label' => 'Importe Total')); ?>
            <?php
            echo $this->Form->input('Mesa.estado_id', array(
                'label' => '¿Qué mesas?<br />',
                'empty' => 'Seleccione',
            ));
            ?>
        </div>


        <div class="ui-block-c">
            <strong>Fecha y hora de Apertura</strong>
            <?php
            echo $this->Jqm->datepicker('Mesa.created_desde', array(
                'label' => 'Abierta desde',
            ));
            ?>
            <?php
            echo $this->Jqm->datepicker('Mesa.created_hasta', array(
                'label' => 'Abierta hasta',
            ));
            ?>
        </div>

        <div class="ui-block-d">
            <strong>Fecha y hora de Cierre</strong>
            <?php
            echo $this->Jqm->datepicker('Mesa.time_cerro_desde', array(
                'label' => 'Cerró desde',
            ));
            ?>
            <?php
            echo $this->Jqm->datepicker('Mesa.time_cerro_hasta', array(
                'label' => 'Cerró hasta',
            ));
            ?>
        </div>

        <div class="ui-block-e">
            <strong>Fecha y hora de Cobro</strong>
            <?php
            echo $this->Jqm->datepicker('Mesa.time_cobro_desde', array(
                'label' => 'Cobrada desde',
            ));
            ?>
            <?php
            echo $this->Jqm->datepicker('Mesa.time_cobro_hasta', array(
                'label' => 'Cobrada hasta',
            ));
            ?>
        </div>

        <?php echo $this->Form->end("Buscar") ?>
    </div>

    <?php
    echo $this->Paginator->counter(
            'Page {:page} of {:pages}, showing {:current} records out of
     {:count} total, starting on record {:start}, ending on {:end}'
    );

    if ($this->Paginator->params['paging']['Mesa']['count'] != 0) {
        echo $this->element('mesas/listado_tabla');
    } else {
        echo('</br><strong>No se encontraron mesas</strong>');
    }
    ?>
</div>
<div class="paging">
    <?php echo $this->Paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
    | 	<?php echo $this->Paginator->numbers(); ?>
    <?php echo $this->Paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
</div>
<div class="actions">
    <ul>
        <li><?php echo $this->Html->link(__('Crear Mesa', true), array('action' => 'add')); ?></li>
    </ul>
</div>

</div>  