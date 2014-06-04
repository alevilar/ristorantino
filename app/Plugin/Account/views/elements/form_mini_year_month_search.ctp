<?
if ( empty($modelName) ) {
    $modelName = Inflector::classify($this->name);
}
echo $form->create($modelName, array(
    'url' => array('controller' => $this->name,'action' => $this->action), 
    'type' => 'get', 
    'name' => 
    'gasto_x_mes'
    ));
?>

<style>
    .ui-field-contain .ui-select {
        width: 90%;
    }
    
</style>

<div class="row">
    <div class="col-md-2">
        <?php
        echo $form->input('cierre_id', array(
            'label' => 'Estado',
            'options' => array(
                1 => 'Abierto',
                2 => 'Cerrado',
            ),
            'label' => false,
            'empty' => 'Estado',
            'placeholder' => 'Estado',
            ));
        ?>
    </div>
    <div class="col-md-2">
        <?php
        if (!empty($proveedores)) {
            echo $form->input('proveedor_id', array(
                'label'=>false, 
                'empty' => 'Proveedor',
                'placeholder' => 'Proveedor'));
        } else {
            echo "&nbsp;";
        }
        ?>
    </div>
    <div class="col-md-2">
        <?php
        if (!empty($clasificaciones)) {
        echo $form->input('clasificacion_id', array(
            'empty' => 'Clasificacion',
            'label'=>false));
        } else {
            echo "&nbsp;";
        }
        ?>
    </div>
    <div class="col-md-2">
        <?php
        echo $form->input('fecha_desde', array('label'=>false, 'type' => 'date', 'pladeholder'=>'Desde'));
        ?>
    </div>
    <div class="col-md-2">
        <?php
        echo  $form->input('fecha_hasta', array('label'=>false,'placeholder'=>'Hasta', 'type' => 'date'));
        ?>
    </div>
    <div class="col-md-1">
        <?php
        echo  $form->input('importe_neto', array('label'=>false, 'placeholder'=>'Neto'));
        ?>
    </div>
    <div class="col-md-1">
        <?php
        echo  $form->button('Buscar', array('class'=>'btn btn-primary', 'type'=>'submit'));
        ?>
    </div>
</div>

<?php echo $form->end(); ?>