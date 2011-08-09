<?php

echo $html->css('protoplasm',false);
echo $javascript->link('protoplasm/protoplasm', false);

echo $javascript->link('mesas/index_head', false);

?>

<?php
$paginator->options(array('url' => $this->passedArgs));
?>

<div id="mesas-index">
<div>
<h2 style="text-align: center;"><?php __('Buscador de Mesas');?></h2>
</br>
<?php echo $form->create("Mesa",array("action"=>"index")); ?>
<div class="alpha grid_1">
    <strong>#</strong>
    <?php echo $form->input('Mesa.numero',array('label'=>'N°Mesa', 'style'=>'width: 47px;'));?>
    <?php echo $form->input('Mozo.numero',array('label'=>'N°Mozo', 'style'=>'width: 47px;'));?>
</div>
<div class="grid_2">
    <strong>Mesa</strong>
    <?php echo $form->input('Mesa.total',array('label'=>'Importe Total', 'style'=>'width: 100px;'));?>
    <?php echo $form->input('Mesa.estado_cerrada',array(
        'label'=> '¿Qué mesas?',
        'type' => 'select',
        'options' => array(
            'todas'=>'Todas las mesas',
            'abiertas' => 'Sólo Abiertas',
            'cerradas' => 'Sólo Cerradas pero sin Cobrar',
            'cobradas' => 'Sólo Cerradas y Cobradas'),
            'style'=>'width: 112px;'
        ));?>
</div>
    

<div class="grid_3">
    <strong>Fecha y hora de Apertura</strong>
    <?php echo $form->input('Mesa.created_from',array(
        'label'=>'Abierta desde',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
    <?php echo $form->input('Mesa.created_to',array(
        'label'=>'Abierta hasta',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
</div>

<div class="grid_3">
    <strong>Fecha y hora de Cierre</strong>
    <?php echo $form->input('Mesa.time_cerro_from',array(
        'label'=>'Cerró desde',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
    <?php echo $form->input('Mesa.time_cerro_to',array(
        'label'=>'Cerró hasta',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
</div>

<div class="grid_3">
    <strong>Fecha y hora de Cobro</strong>
    <?php echo $form->input('Mesa.time_cobro_from',array(
        'label'=>'Cobrada desde',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
    <?php echo $form->input('Mesa.time_cobro_to',array(
        'label'=>'Cobrada hasta',
        'class' => 'datepicker',
        'style' => 'width: 130px;'
        ));
    ?>
</div>
<div class="clear"></div>

    <?php echo $form->end("Buscar")?>


</br></br></br>
<p>
<?php

echo $paginator->counter(array(
'format' => __('Pagina %page% de %pages%, mostrando %current% elementos de %count%', true)
));
?></p>
<?php 
if ($paginator->params['paging']['Mesa']['count']!=0) { 
            echo $this->element('mesas/listado_tabla');
}else{
    echo('</br><strong>No se encontraron mesas</strong>');
}                  
?>


</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('anterior', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('próximo', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Crear Mesa', true), array('action'=>'add')); ?></li>
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