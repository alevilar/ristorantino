<?php
$ingresoEfectivo = $egresoEfectivo = null;

echo $html->css('/cash/css/style_cash');

echo $html->css('/css/jquery.timepicker');

echo $javascript->link('/js/jquery/jquery.timepicker');
?>

<div class="grid_3 alpha">

    <?php
    $cajaName = 'Caja';
    if (!empty($caja) && !empty($caja['Caja']) && !empty($caja['Caja']['name'])) {
        $cajaName = $caja['Caja']['name'];
    }
    $desde = date('d/m/y H:i:s', strtotime($desde));
    $hasta = date('d/m/y H:i:s', strtotime($hasta));
    echo "Tablas de datos con información<br>desde: $desde<br>hasta $hasta";
    ?>
    <?php if ( !empty($ingresosList)) { ?>
    <table class="mini">
        <caption>Ingresos</caption>
        <tbody>
            <tr>
                <th>Tipo de Pago</th>
                <th>Total</th>
            </tr>
            <?php foreach ($ingresosList as $ing) { ?>
                <tr>
                    <td>
                        <?php echo $ing['TipoDePago']['name'] ?>
                    </td>
                    <td>
                        <?php echo $ing[0]['total'] ?>
                    </td>
                </tr>
            <?php } ?>   
        </tbody>
    </table>
    <?php } ?>


    <?php if ( !empty($egresosList) ) { ?>
    <table class="mini">
        <caption>Egresos</caption>
        <tbody>
            <tr>
                <th>Tipo de Pago</th>
                <th>Total</th>
            </tr>
            <?php foreach ($egresosList as $eg) { ?>
                <tr>
                    <td>
                        <?php echo $eg['TipoDePago']['name'] ?>
                    </td>
                    <td>
                        <?php echo $eg[0]['total'] ?>
                    </td>
                </tr>
            <?php } ?>    
        </tbody>
    </table>
    <?php } ?>

</div>

<?php
echo $form->create('Arqueo');

echo $form->input('id');
?>
<div class="grid_5" id="arqueoContainer">
    <h2>Nuevo Arqueo de <?php echo $cajaName?></h2>

    <div class="grid_6">
        <?php
        if (empty($this->data['Arqueo']['caja_id'])) {
            echo $form->input('caja_id');
        } else {
            echo $form->hidden('caja_id');
        }
        echo $form->input('datetime', array('class' => "datepicker muted", 'type' => 'text', 'label'=>'Fecha y Hora', 'div'=>array('style'=>'width:100%;')));
        echo $form->input('importe_final');
        echo $form->input('saldo', array('disabled' => true));
        echo $form->input('observacion', array('label' => 'Obs. del Arqueo', 'style' => 'height:100px'));
        ?>
    </div>

    <div class="grid_6">
        <?php
        echo $form->input('importe_inicial', array('class' => 'muted'));
        echo $form->input('ingreso', array('label' => 'Ingresos en efectivo', 'class' => 'muted'));
        echo $form->input('egreso', array('label' => 'Egresos en efectivo', 'class' => 'muted'));
        echo $form->input('otros_ingresos', array('class' => 'muted'));
        echo $form->input('otros_egresos', array('class' => 'muted'));
        ?>
    </div>  

</div>

<div class="grid_4 zeta">
    <?php
    $display = "";
    if (empty($this->data['Arqueo']['hacer_cierre_zeta'])) {
        $display = 'display: none';
    }
    ?>
    <?php
    echo $form->input('hacer_cierre_zeta', array('type' => 'checkbox'));
    echo $form->hidden('Zeta.id');
    ?>
    <div class="clear clearfix"></div>    
    <div class="mostrar_zeta grid_12" style="<?php echo $display ?>">
        <h2>Cierre Z</h2>

        <div class="grid_6 alpha">
            <?php
            echo $form->input('Zeta.total_ventas', array('label' => 'Ventas del Día', 'class' => 'muted'));
            echo $form->input('Zeta.monto_neto');
            echo $form->input('Zeta.nota_credito_neto');
            echo $form->input('Zeta.observacion', array('label' => 'Obs. General Z'));
            ?>
        </div>

        <div class="grid_6 omega">
            <?php
            echo $form->input('Zeta.numero_comprobante', array('label' => '#Comprobante', 'class' => 'muted'));
            echo $form->input('Zeta.monto_iva');
            echo $form->input('Zeta.nota_credito_iva');
            echo $form->input('Zeta.observacion_comprobante_tarjeta', array('label' => 'Obs. Tarjetas'));
            ?>
        </div>

    </div>
</div>


<div style="text-align: center; margin-left: 20%;">
    <?php echo $form->button('Guardar Arqueo', array('type' => 'submit', 'style' => ' background-color: #1c94c4; color: white; padding: 30px; text-align: center;')); ?>
</div>
<?php
echo $form->end();
?>


<div id="billetines" class="hidden">
    <a class="pull-right" href="#billetines" onclick="jQuery('#billetines').hide()"><b>Cerrar</b></a>
        <br><br>
        <p class="muted">Ingresar cantidades de cada billete</p>
        <?php 
        echo $form->create('Billetes');
        echo $form->input('b100', array('label' => '100'));
        echo $form->input('b50', array('label' => '50'));
        echo $form->input('b20', array('label' => '20'));
        echo $form->input('b10', array('label' => '10'));
        echo $form->input('b5', array('label' => '5'));
        echo $form->input('b2', array('label' => '2'));
        echo $form->input('b1', array('label' => '1'));
        echo $form->input('b0', array('label' => '0,50C'));
        echo $form->input('bA', array('label' => 'Otro'));
        echo $form->end(null);
        ?>
</div>


<?php echo $javascript->link('/cash/js/arqueos_add') ?>
 