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

<div class="ui-grid-d">
    <div class="ui-block-a">
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
            'onchange' => 'this.form.submit()'));
        ?>
    </div>
    <div class="ui-block-b">
        <?php
        if (!empty($proveedores)) {
            echo $form->input('proveedor_id', array(
                'onchange' => 'this.form.submit()', 
                'label'=>false, 
                'empty' => 'Proveedor',
                'placeholder' => 'Proveedor'));
        } else {
            echo "&nbsp;";
        }
        ?>
    </div>
    <div class="ui-block-c">
        <?php
        if (!empty($clasificaciones)) {
        echo $form->input('clasificacion_id', array(
            'onchange' => 'this.form.submit()', 
            'empty' => 'Clasificacion',
            'label'=>false));
        } else {
            echo "&nbsp;";
        }
        ?>
    </div>
    <div class="ui-block-d">
        <?php
        echo $form->input('fecha_desde', array('onchange' => 'this.form.submit()', 'label'=>'Desde', 'type' => 'date'));
        ?>
    </div>
    <div class="ui-block-e">
        <?php
        echo  $form->input('fecha_hasta', array('onchange' => 'this.form.submit()', 'label'=>'Hasta', 'type' => 'date'));
        ?>
    </div>
</div>

<?php echo $form->end(); ?>