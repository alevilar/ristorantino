<?php
echo $this->element('form_mini_year_month_search');
echo $html->css('/account/css/style');
?>


<h1>Listado de Gastos</h1>

<?php echo $form->create('Cierre'); ?>
<div id='place-for-inputs' class="cq-hide"></div>
<div id='descripcion-cierre' class="well cq-hide">
    <div class="pull-right">
        <span class="glyphicon glyphicon-info-sign"></span>
        <small><cite>Al cerrar un conjunto de gastos se impide que estos sean modificados.</cite></small>
    </div>
    <p><span class='detalle-gastos'></span> gastos seleccionados</p>
    <?php
    echo $form->input('name', array('placeholder'=>'Ejemplo: Cierre de Abril','label' => 'breve descripción del cierre', 'required' => true));
    echo $form->button('Cancelar', array('type' => 'button', 'onclick'=>'$("#descripcion-cierre").hide("fade")', 'class'=>'btn'));
    echo "&nbsp;";
    echo $form->button('Guardar', array('type' => 'submit', 'class'=>'btn btn-primary'));
    
    ?>
</div>


<div class="btn-group">
<?php
echo $form->button('Aplicar Cierre', array(
    'type' => 'button',
    'data-theme' => 'b',
    'data-inline' => 'true',
    'data-role' => 'button',
    'class' => 'btn btn-default',
    'id' => 'btn-gastos-apli-cierre'));

echo $form->end();
?>

<?php



echo $html->link('Descargar Excel', $this->action . '.xls' . strstr($_SERVER['REQUEST_URI'], '?'), array(
    'data-ajax' => 'false',
    'class' => 'btn btn-success',
));
?>
    </div>

<br>

<?php echo $this->element('gastos_full_table'); ?>

