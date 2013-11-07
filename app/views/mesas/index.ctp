<?php
echo $javascript->link('mesas/index_head', false);
echo $this->element('menuadmin');


$paginator->options(array('url' => $this->passedArgs));
?>

<div id="mesas-index">

    <div>
        <h2 style="text-align: center;"><?php __('Buscador de Mesas'); ?></h2>
        <?php echo $form->create("Mesa", array("action" => "index")); ?>
        <div class=" col-md-1">
            <?php echo $form->input('Mesa.numero', array('label' => 'N°Mesa')); ?>
            <?php echo $form->input('Mozo.numero', array('label' => 'N°Mozo')); ?>
        </div>
        <div class="col-md-2">
            <?php echo $form->input('Mesa.total', array('label' => 'Importe', 'style' => 'width: 100px;'));
            echo $form->input('Mesa.estado_cerrada', array(
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
            echo $form->input('Mesa.created_from', array(
                'label' => 'Abierta desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $form->input('Mesa.created_to', array(
                'label' => 'Abierta hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $form->input('Mesa.time_cerro_from', array(
                'label' => 'Cerró desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $form->input('Mesa.time_cerro_to', array(
                'label' => 'Cerró hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
        </div>

        <div class="col-md-3">
            <?php
            echo $form->input('Mesa.time_cobro_from', array(
                'label' => 'Cobrada desde',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
            <?php
            echo $form->input('Mesa.time_cobro_to', array(
                'label' => 'Cobrada hasta',
                'class' => 'datetimepicker form-control',
                'data-format' =>  "yyyy/MM/dd hh:mm:ss",
            ));
            ?>
        </div>
        <div class="clear"></div>

        <?php echo $form->end("Buscar") ?>


        <p>
            <?php
            echo $paginator->counter(array(
                'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
            ));
            echo "..... y suman un total de <b>$$mesas_suma_total</b> pesos";
            ?></p>

        <?php
        if ($paginator->params['paging']['Mesa']['count'] != 0) {
            echo $this->element('mesas/listado_tabla');
        } else {
            echo('</br><strong>No se encontraron mesas</strong>');
        }
        ?>


    </div>
    <div class="paging">
        <?php echo $paginator->prev('<< ' . __('anterior', true), array(), null, array('class' => 'disabled')); ?>
        | 	<?php echo $paginator->numbers(); ?>
        <?php echo $paginator->next(__('próximo', true) . ' >>', array(), null, array('class' => 'disabled')); ?>
    </div>
    <div class="actions">
        <ul>
            <li><?php echo $html->link(__('Crear Mesa', true), array('action' => 'add')); ?></li>
        </ul>
    </div>

</div>  