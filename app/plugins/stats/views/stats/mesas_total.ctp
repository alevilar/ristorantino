<?php
echo $html->css('/stats/css/examples', false);
echo $html->css('/stats/css/stats', false);


echo $javascript->link('/stats/js/jqplot/jquery.jqplot.js', false); //plugin estadisticas
echo $javascript->link('/stats/js/jqplot/plugins/jqplot.dateAxisRenderer.js', false);
echo $javascript->link('/stats/js/jqplot/plugins/jqplot.highlighter.js', false);

echo $javascript->link('/stats/js/mesas_total', false); //plugin estadisticas
?>


<script language="javascript" type="text/javascript">    
    var mesas = [],
    egresos = [];
<?php if (!empty($mesas)) { ?>
        mesas= <?php echo json_encode($mesas); ?>;
<?php } ?>
    
<?php if (!empty($egresos)) { ?>
        egresos= <?php echo json_encode($egresos); ?>;
<?php } ?>
</script>

<div class="grid_4 alpha">
    <?php
    echo $form->create('Mesa', array('url' => array('controller' => 'stats', 'action' => 'mesas_total'), 'class' => ''));
    ?>

    <h2>Rango de Fechas</h2>

    <?php
    echo "Desde: " . $form->text('Linea.0.desde', array('placeholder' => 'Ej: 22/09/2011', 'id' => 'from', 'class' => 'datepicker'));
    echo "Hasta: " . $form->text('Linea.0.hasta', array('placeholder' => 'Ej: 30/09/2011', 'id' => 'to', 'class' => 'datepicker'));
    echo $form->submit('Aceptar', array('style' => 'margin-left: 136px', 'div' => false));
    ?>

    <?php
    echo $form->end();
    ?>
    <div class="clear clearfix"></div>
</div>

<div class="grid_8 omega">
    Datos entre <b><?php echo strftime('%A %d de %B %Y', strtotime($resumenCuadro['desde'])) ?></b> y <b><?php echo strftime('%A %d de %B %Y', strtotime($resumenCuadro['hasta'])) ?></b>
        <br />
    <div class="grid_6 alpha">
        <h3>Ingresos/Ventas</h3>
        Total de ventas: <b><?php echo $number->currency($resumenCuadro['total']) ?></b><br />
        Cierre Zeta Total: <b><?php echo $number->currency($zeta_iva_total+$zeta_neto_total) ?></b><br>
        Zeta Neto: <b><?php  echo $number->currency($zeta_neto_total) ?></b><br>
        Zeta Iva: <b><?php echo $number->currency($zeta_iva_total) ?></b><br>
        
        <p>Cantidad de cubiertos: <b><?php echo $resumenCuadro['cubiertos'] ?></b></p>
    </div>
    
    <div class="grid_6 omega">
        <h3>Egresos/Pagos</h3>
        Pagos: <b><?php echo $number->currency($egresos_total)?></b>
        <br><br>
        Gastos Total: <b><?php echo $number->currency($gastos_total) ?></b><br>
        Gasto Neto: <b><?php echo $number->currency($gastos_neto) ?></b><br>
        Gastos Impuestos: <b><?php echo $number->currency($gastos_total-$gastos_neto) ?></b><br>
    </div>
    <div class="clear"></div>
</div>
<hr />
<div class="clear"></div>
<hr />
<div class="col-md-12 alpha omega">
<div id="chart1" ></div>
</div>

<div class="clear clearfix"></div>

<div class="grid_5 alpha">
    <?php
    foreach ($mesas as $i => $mozo) {
        if (!empty($mozo['desde']))
            
            ?>
        <div class="tabla-info">
            <h3>Ventas</h3>
            <table cellspacing="0" cellpadding="0" style="text-align: center; width: 100%">
                <thead>
                    <tr>
                        <th <?php
    if ($i == 0) {
        echo('class="coloruno"');
    } else {
        echo('class="colordos"');
    }
        ?>>Fecha</th>
                        <th <?php
                        if ($i == 0) {
                            echo('class="coloruno"');
                        } else {
                            echo('class="colordos"');
                        }
        ?>>Total</th>   
                        <th <?php
                        if ($i == 0) {
                            echo('class="coloruno"');
                        } else {
                            echo('class="colortres"');
                        }
        ?>>$Cubierto</th>
                        
                        <th <?php
                        if ($i == 0) {
                            echo('class="coloruno"');
                        } else {
                            echo('class="colordos"');
                        }
        ?>>Mesas</th>
                        <th <?php
                        if ($i == 0) {
                            echo('class="coloruno"');
                        } else {
                            echo('class="colortres"');
                        }
        ?>>Cubiertos</th>
                        
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($mozo)) {

                        foreach ($mozo as $m) {
                            echo('<tr>');
                            echo('<td>');
                            echo(strftime('%a %d %b', strtotime($m['Mesa']['fecha'])));
                            echo('</td>');
                            echo('<td>');

                            echo('$');
                            echo($m['Mesa']['total']);
                            echo('</td>');
                            
                            // prom cubiertos
                            echo('<td>');
                            if ($m['Mesa']['cant_cubiertos']) {
                                echo $number->currency($m['Mesa']['total'] / $m['Mesa']['cant_cubiertos']);
                            } else {
                                echo $number->currency($m['Mesa']['total']);
                            }
                            echo('</td>');
                           
                            echo('<td>');
                            echo($m['Mesa']['cant_mesas']);
                            echo('</td>');
                            echo('<td>');
                            echo($m['Mesa']['cant_cubiertos']);
                            echo('</td>');
                            
                            echo('</tr>');
                        }
                    } else {
                        echo('<td>');
                        echo('No se encontraron mesas');
                        echo('</td>');
                        echo('<td>');
                        echo('-');
                        echo('</td>');
                    }
                    echo('</tr>');
                    ?>  
                </tbody>              
            </table>

        </div>  
        <?php
    }
    ?>
    <div class="clear"></div>
</div>

<div class="grid_4">
    <div class="tabla-info">
        <h3>Zetas</h3>
        <table cellspacing="0" cellpadding="0" style="text-align: center; width: 100%">
            <thead>
                <tr>
                    <th style="background: #00650e; color: white; text-align: center;">Fecha</th>
                    <th style="background: #00650e; color: white; text-align: center;">Neto</th>
                    <th style="background: #00650e; color: white; text-align: center;">Iva</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($zetas as $z) { ?>
            <tr>
                <td><?php echo strftime('%a %d %b',strtotime($z[0]['fecha'])); ?></td>
                <td><?php echo $number->currency($z[0]['neto'])?></td>
                <td><?php echo $number->currency($z[0]['iva'])?></td>
            </tr>
        <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<div class="grid_3 omega">
    <div class="tabla-info">
        <h3>Pagos</h3>
        <table cellspacing="0" cellpadding="0" style="text-align: center; width: 100%">
            <thead>
                <tr>
                    <th style="background: #EAA228; color: white; text-align: center;">Fecha</th>
                    <th style="background: #EAA228; color: white; text-align: center;">Importe pagado</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($egresos[0] as $e) { ?>
                    <tr>
                        <td><?php echo strftime('%a %d %b', strtotime($e['Egreso']['fecha']));?></td>
                        <td><?php echo $number->currency($e['Egreso']['importe']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="clear"></div>
</div>

<div class="clear"></div>