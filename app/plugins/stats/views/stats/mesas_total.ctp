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

<div>
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



    <p>
        Resumen del Cuadro: <br />
        Fecha, entre <b><?php echo date('D d, M Y', strtotime($resumenCuadro['desde'])) ?></b> y <b><?php echo date('D d, M Y', strtotime($resumenCuadro['hasta'])) ?></b>
        <br />Total de ventas: <b><?php echo money_format('%2n', $resumenCuadro['total']) ?></b><br />
        Cantidad de cubiertos: <b><?php echo $resumenCuadro['cubiertos'] ?></b>
    </p>
    <div id="chart1" ></div>
    <div class="clear"></div>
</div>

<div class="clear"></div>

<div class="grid_6 alpha">
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
                        <th <?php
                        if ($i == 0) {
                            echo('class="coloruno"');
                        } else {
                            echo('class="colortres"');
                        }
        ?>>Prom. Cubierto</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if (!empty($mozo)) {

                        foreach ($mozo as $m) {
                            echo('<tr>');
                            echo('<td>');
                            echo(date('D d, M', strtotime($m['Mesa']['fecha'])));
                            echo('</td>');
                            echo('<td>');

                            echo('$');
                            echo($m['Mesa']['total']);

                            echo('</td>');
                           
                            echo('<td>');
                            echo($m['Mesa']['cant_mesas']);
                            echo('</td>');
                            echo('<td>');
                            echo($m['Mesa']['cant_cubiertos']);
                            echo('</td>');
                            echo('<td>');
                            if ($m['Mesa']['cant_cubiertos']) {
                                echo $number->currency($m['Mesa']['total'] / $m['Mesa']['cant_cubiertos']);
                            } else {
                                echo $number->currency($m['Mesa']['total']);
                            }
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

<div class="grid_6 omega">
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
                        <td><?php echo $e['Egreso']['fecha'] ?></td>
                        <td><?php echo $number->currency($e['Egreso']['importe']) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="clear"></div>
</div>
<div class="clear"></div>