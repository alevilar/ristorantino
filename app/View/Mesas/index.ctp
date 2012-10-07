<?php
//echo $this->Html->css('protoplasm',false);
//echo $javascript->link('protoplasm/protoplasm', false);

echo $this->Html->link('mesas/index_head', false);
?>

<?php
echo $this->element('menuadmin');
?>

<?php
$this->Paginator->options(array('url' => $this->passedArgs));
?>

<div id="mesas-index">
    <div>
        <h2 style="text-align: center;"><?php __('Buscador de Mesas'); ?></h2>
        </br>
<?php echo $this->Form->create("Mesa", array("action" => "index")); ?>
        <div class="alpha grid_1">
            <strong>#</strong>
<?php echo $this->Form->input('Mesa.numero', array('label' => 'N°Mesa', 'style' => 'width: 47px;')); ?>
            <?php echo $this->Form->input('Mozo.numero', array('label' => 'N°Mozo', 'style' => 'width: 47px;')); ?>
        </div>
        <div class="grid_2">
            <strong>Mesa</strong>
<?php echo $this->Form->input('Mesa.total', array('label' => 'Importe Total', 'style' => 'width: 100px;')); ?>
            <?php
            echo $this->Form->input('Mesa.estado_cerrada', array(
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


        <div class="grid_3">
            <strong>Fecha y hora de Apertura</strong>
            <?php
            echo $this->Form->input('Mesa.created_from', array(
                'label' => 'Abierta desde',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
            <?php
            echo $this->Form->input('Mesa.created_to', array(
                'label' => 'Abierta hasta',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
        </div>

        <div class="grid_3">
            <strong>Fecha y hora de Cierre</strong>
            <?php
            echo $this->Form->input('Mesa.time_cerro_from', array(
                'label' => 'Cerró desde',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
            <?php
            echo $this->Form->input('Mesa.time_cerro_to', array(
                'label' => 'Cerró hasta',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
        </div>

        <div class="grid_3">
            <strong>Fecha y hora de Cobro</strong>
            <?php
            echo $this->Form->input('Mesa.time_cobro_from', array(
                'label' => 'Cobrada desde',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
            <?php
            echo $this->Form->input('Mesa.time_cobro_to', array(
                'label' => 'Cobrada hasta',
                'class' => 'datepicker',
                'style' => 'width: 130px;'
            ));
            ?>
        </div>
        <div class="clear"></div>

            <?php echo $this->Form->end("Buscar") ?>


        </br></br></br>
        <p>
            <?php
//            echo $this->Paginator->counter(array(
//                'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
//            ));
//            echo "..... y suman un total de <b>$$mesas_suma_total</b> pesos";
            ?></p>

        <?php
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