<?php //echo $this->Html->css('/account/css/style'); ?>
<h1>Viendo detalle del Cierre <small><cite>"<?php echo $cierre['Cierre']['name'] ?>"</cite></small></h1>

<p>
    creado: <?php echo date('d-m-Y H:i', strtotime($cierre['Cierre']['created'])); ?>
</p>

<h3>Listado de los Gastos que entraron en este cierre</h3>

<?php


echo $this->Html->link('Descargar Excel', $this->action . "/".$cierre['Cierre']['id']. '.xls' . strstr($_SERVER['REQUEST_URI'], '?'), array(
    'data-ajax' => 'false',
    'class' => 'btn btn-success',
));
?>

<?php echo $this->element('gastos_full_table'); ?>