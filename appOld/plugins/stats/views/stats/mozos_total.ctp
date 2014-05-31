

<div class="well pull-right">
    <?php
    echo $form->create('Mesa', array('url' => $this->action, 'class' => 'form-inline formufecha'));
    ?>
    <legend>Filtrar por rango de fechas</legend>
    <?php
    echo $form->input('desde', array('type' => 'date', 'label'=>false));
    echo $form->input('hasta', array('type' => 'date', 'label'=>false));
    echo $form->submit('Aceptar', array('class' => 'btn btn-default', 'div' => false));
    echo $form->end();
    ?>

</div>

<h1>Ventas Por Mozo</h1>


<div class="clearfix"></div>

<div class="row">
    <table class="table table-bordered table-condensed table-responsive table-striped ">
        <thead>
            <tr>
                <th class="text-center">Mozo N°</th>
                <?php foreach ($mozos as $mz) { ?>
                <th colspan="2" class="text-center"><?php echo $mz ?></th>
                <?php } ?>
            </tr>
            <tr>
                <th class="text-center">Fecha</th>
                <?php foreach ($mozos as $mz) { ?>
                <th class="text-center"><span class="glyphicon glyphicon-cutlery"></span></th>
                <th class="text-right"><span class="glyphicon glyphicon-usd"></span></th>
                <?php } ?>
            </tr>
        </thead>
        
        <tfoot class="text-primary">
            <tr>
                <td class="text-center">TOTALES</td>
                <?php foreach($mozosTotales as $mt) { ?>
                <td class="text-center"><?php echo $mt['cubiertos']; ?></td>
                <td class="text-right"><?php echo $number->currency($mt['total'],'$', array('places'=>0)); ?></td>
                <?php } ?>
            </tr>
        </tfoot>
        
        <tbody>
            <?php foreach ($fechas as $fDate=>$f) { ?>
                <tr>
                    <td class="text-center"><?php echo $fDate;?></td>
                    
                    <?php foreach ($f as $mId=>$mdata) { ?>
                    <td class="text-center"><?php echo $mdata[0]['cant_cubiertos']?></td>
                        <td class="text-right"><?php echo $number->currency($mdata[0]['total'],'$', array('places'=>0));?></td>
                    <?php } ?>
                </tr>
            <?php } ?>
        </tbody>
        
    </table>
</div>

