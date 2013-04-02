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

<div class="ui-grid-b">
    <div class="ui-block-a">
        <?php
        echo $form->input('closed', array(
            'label' => 'Estado',
            'options' => array(
                1 => 'Abierto',
                2 => 'Cerrado',
            ),
            'empty' => 'Seleccione',
            'onchange' => 'this.form.submit()'));
        ?>
    </div>
    <div class="ui-block-b">
        <?php
        echo $jqm->month('mes', array('onchange' => 'this.form.submit()'));
        ?>
    </div>
    <div class="ui-block-c">
        <?php
        $lastYears = array_combine(range(date("Y"), date('Y', strtotime('-5 years'))), range(date("Y"), date('Y', strtotime('-5 years'))));
        echo $form->input('anio', array(
            'label' => 'Año',
            'options' => $lastYears,
            'onchange' => 'this.form.submit()', 
            'default' => date('Y', strtotime('now'))
            ));
        ?>
    </div>
</div>

<?php echo $form->end(); ?>