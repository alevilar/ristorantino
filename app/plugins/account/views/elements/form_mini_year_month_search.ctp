<?
$modelName = Inflector::classify($this->name);
echo $form->create($modelName, array('action' => $this->action, 'type' => 'get', 'name' => 'gasto_x_mes'));
?>

<div class="ui-grid-a">
    <div class="ui-block-a">
        <?php
        echo $jqm->month('mes', array('onchange' => 'this.form.submit()'));
        ?>
    </div>
    <div class="ui-block-b">
        <?php
        $lastYears = array_combine(range(date("Y"), date('Y', strtotime('-5 years'))), range(date("Y"), date('Y', strtotime('-5 years'))));
        echo $form->input('anio', array(
            'label' => 'Año',
            'options' => $lastYears,
            'onchange' => 'this.form.submit()', 'default' => date('Y', strtotime('now'))));
        ?>
    </div>
</div>

<?php echo $form->end(); ?>