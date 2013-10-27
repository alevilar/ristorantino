<?php
$ingresoEfectivo = $egresoEfectivo = null;

echo $html->css('/cash/css/style');
?>

<div class="grid_3 alpha">

    <?php if ( empty($caja) || ( isset($caja['Caja']['computa_ingresos']) && !empty($caja['Caja']['computa_ingresos']) ) ) { ?>
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


    <?php if ( empty($caja) || ( isset($caja['Caja']['computa_egresos']) && !empty($caja['Caja']['computa_egresos']) ) ) { ?>
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
    <h2>Nuevo Arqueo de Caja</h2>

    <div class="grid_6">
        <?php
        if (empty($this->data['Arqueo']['caja_id'])) {
            echo $form->input('caja_id');
        } else {
            echo $form->hidden('caja_id');
        }
        echo $form->input('datetime', array('class' => "datepicker muted", 'type' => 'text'));
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


<?php echo $javascript->link('/cash/js/arqueos_add') ?>
 