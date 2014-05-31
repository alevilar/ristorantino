<?php
echo $this->Html->script('mesas/index_head', false);


// $this->Paginator->options(array('url' => $this->passedArgs));
// $this->Paginator->options(array('convertKeys' => array(
//     'page'
//     )));
?>

<div id="mesas-index">

    <div>
        <h2 style="text-align: center;"><?php __('Buscador de Mesas'); ?></h2>
        <?php echo $this->Form->create("Mesa", array("action" => "index")); ?>
        <div class=" col-md-1">
            <?php echo $this->Form->input('numero', array('label' => 'N°Mesa')); ?>
            <?php echo $this->Form->input('mozo_numero', array('label' => 'N°Mozo')); ?>
        </div>
        <div class="col-md-2">
            <?php echo $this->Form->input('total', array('label' => 'Importe', 'style' => 'width: 100px;'));
            echo $this->Form->input('estado_id', array(
                'label' => '¿Qué mesas?',
                'type' => 'select',
                'options' => array(
                    'todas' => 'Todas las mesas',
                    'abiertas' => 'Sólo Abiertas',
                    'cerradas' => 'Sólo Cerradas pero sin Cobrar',
                    'cobradas' => 'Sólo Cerradas y Cobradas'),
                'style' => 'width: 112px;'
            ));
            ?>
        </div>


        <div class="col-md-3">
            <?php
            echo $this->Form->input('created_from', array(
                'label' => 'Abierta desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('created_to', array(
                'label' => 'Abierta hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $this->Form->input('time_cerro_from', array(
                'label' => 'Cerró desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('time_cerro_to', array(
                'label' => 'Cerró hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $this->Form->input('time_cobro_from', array(
                'label' => 'Cobrada desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $this->Form->input('time_cobro_to', array(
                'label' => 'Cobrada hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy-MM-dd hh:mm:ss",
            ));
            ?>
        </div>
        <div class="clear"></div>

        <?php echo $this->Form->end("Buscar") ?>


        <p class="text-center">
            <?php
            echo $this->Paginator->counter(
                'Page {:page} of {:pages}, showing {:current} records out of
                 {:count} total, starting on record {:start}, ending on {:end}'
            );
            
            // echo "..... y suman un total de <b>$$mesas_suma_total</b> pesos";
            ?>
        </p>

        <?php
        if ($this->Paginator->params['paging']['Mesa']['count'] != 0) {
            echo $this->element('listado_tabla');
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