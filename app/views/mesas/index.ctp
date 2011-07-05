
<?php

echo $html->css('protoplasm',false);
echo $javascript->link('protoplasm/protoplasm', false);

echo $javascript->link('mesas/index_head', false);


?>



<?php
$paginator->options(array('url' => $this->passedArgs));
?>

<div id="mesas-index" class="container_12">
<div class="mesas index grid_12">
<h2><?php __('Buscador de Mesas');?></h2>

<?php echo $form->create("Mesa",array("action"=>"index")); ?>
<div class="alpha grid_1">
    <strong>#</strong>
    <?php echo $form->input('Mesa.numero',array('label'=>'N° Mesa', 'class'=>'grid_12 alpha omega'));?>
    <?php echo $form->input('Mozo.numero',array('label'=>'N° Mozo', 'class'=>'grid_12 alpha omega'));?>
</div>
<div class="grid_2">
    <strong>Mesa</strong>
    <?php echo $form->input('Mesa.total',array('label'=>'Importe Total', 'class'=>'grid_12  alpha omega'));?>
    <?php echo $form->input('Mesa.estado_cerrada',array(
        'label'=> '¿Qué mesas traer?',
        'type' => 'select',
        'options' => array(
            'todas'=>'Todas las mesas',
            'abiertas' => 'Sólo Abiertas',
            'cerradas' => 'Sólo Cerradas pero sin Cobrar',
            'cobradas' => 'Sólo Cerradas y Cobradas'),
        'class'=>'grid_12 alpha omega'
        ));?>
</div>
    

<div class="grid_3">
    <strong>Fecha y hora de Apertura</strong>
    <?php echo $form->input('Mesa.created_from',array(
        'label'=>'Abierta desde',
        'class' => 'datepicker',
        ));
    ?>
    <?php echo $form->input('Mesa.created_to',array(
        'label'=>'Abierta hasta',
        'class' => 'datepicker',
        ));
    ?>
</div>

<div class="grid_3">
    <strong>Fecha y hora de Cierre</strong>
    <?php echo $form->input('Mesa.time_cerro_from',array(
        'label'=>'Cerró desde',
        'class' => 'datepicker',
        ));
    ?>
    <?php echo $form->input('Mesa.time_cerro_to',array(
        'label'=>'Cerró hasta',
        'class' => 'datepicker',
        ));
    ?>
</div>

<div class="grid_3">
    <strong>Fecha y hora de Cobro</strong>
    <?php echo $form->input('Mesa.time_cobro_from',array(
        'label'=>'Cobrada desde',
        'class' => 'datepicker',
        ));
    ?>
    <?php echo $form->input('Mesa.time_cobro_to',array(
        'label'=>'Cobrada hasta',
        'class' => 'datepicker',
        ));
    ?>
</div>
<div class="clear"></div>
    <?php echo $form->input("exportar_excel", array(
        'label'=>'Exportar a Excel',
        'type' => 'checkbox',
        ))?>
    <?php echo $form->end("Buscar")?>

<p>
<?php

echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<?php echo $this->element('mesas/listado_tabla')?>


</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Mesa', true), array('action'=>'add')); ?></li>
	</ul>
</div>

<script type="text/javascript">
//    calendar.set("MesaCreatedTo");
//    calendar.set("MesaCreatedFrom");
//    calendar.set("MesaTimeCerroFrom");
//    calendar.set("MesaTimeCerroTo");
//    calendar.set("MesaTimeCobroFrom");
//    calendar.set("MesaTimeCobroTo");

</script>

</div>  