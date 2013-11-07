<?php
$ingresoEfectivo = $egresoEfectivo = null;

echo $html->css('/cash/css/style_cash');
?>

<div class="col-md-3">
    <div class="panel panel-info">
        <div class="panel-heading">
            <?php
            $cajaName = 'Caja';
            if (!empty($caja) && !empty($caja['Caja']) && !empty($caja['Caja']['name'])) {
                $cajaName = $caja['Caja']['name'];
            }
            $desde = date('d/m/y H:i:s', strtotime($desde));
            $hasta = date('d/m/y H:i:s', strtotime($hasta));
            echo "Tablas de datos con información<br>desde: $desde<br>hasta $hasta";
            ?>
        </div>

        <div class="panel-body">
            <?php if (!empty($ingresosList)) { ?>
                <table class="table table-condensed table-bordered mini">
                    <caption>Ventas</caption>
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


            <?php if (!empty($egresosList)) { ?>
                <table class="table table-condensed table-bordered mini">
                    <caption>Pagos<br>(Módulo contable)</caption>
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
    </div>
    
    <?php echo $form->button('Guardar Arqueo', array('type' => 'submit', 'class'=>'btn btn-lg btn-primary btn-block', 'id'=>'btn-submit', "form"=>"ArqueoAddForm")); ?>
</div>

<div class="col-md-9">
    <div class="row">
        <?php
        echo $form->create('Arqueo', array('id' => 'ArqueoAddForm'));

        echo $form->input('id');

        $classArqueoContainer = 'panel-primary';
        if (isset($this->data['Arqueo']['saldo'])) {
            if (abs($this->data['Arqueo']['saldo']) == 0) {
                $classArqueoContainer = 'panel-success';
            } elseif (abs($this->data['Arqueo']['saldo']) < 11) {
                $classArqueoContainer = 'panel-warning';
            } else {
                $classArqueoContainer = 'panel-danger';
            }
        }
        ?>

        <div class="col-md-7">
            <div class="panel <?php echo $classArqueoContainer; ?>" id='arqueoContainer'>
                <div class="panel-heading">
                    <h2>Arqueo de <?php echo $cajaName ?></h2>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            if (empty($this->data['Arqueo']['caja_id'])) {
                                echo $form->input('caja_id');
                            } else {
                                echo $form->hidden('caja_id');
                            }
                            echo $form->input('datetime', array('class' => "form-control muted", 'type' => 'datetime', 'label' => 'Fecha y Hora'));
                            echo $form->input('importe_final', array('type'=>'number', 'required'=>true));
                            echo $form->input('saldo', array('disabled' => true));
                            echo $form->input('observacion', array('label' => 'Obs. del Arqueo'));
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $form->input('importe_inicial', array('type'=>'number', 'class' => 'form-control muted'));
                            if (!empty($this->data['Arqueo']['ingreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_ingresos']) )) {
                                echo $form->input('ingreso', array('type'=>'number', 'label' => 'Ventas en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $form->hidden('ingreso');
                            }

                            if (!empty($this->data['Arqueo']['egreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_egresos']) )) {
                                echo $form->input('egreso', array('type'=>'number', 'label' => 'Pagos en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $form->hidden('egreso');
                            }
                            echo $form->input('otros_ingresos', array('type'=>'number', 'class' => 'form-control muted'));
                            echo $form->input('otros_egresos', array('type'=>'number', 'class' => 'form-control muted'));
                            ?>
                        </div>  
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?php
                    $display = "";
                    if (empty($this->data['Arqueo']['hacer_cierre_zeta'])) {
                        $display = 'display: none';
                    }
                    echo $form->input('hacer_cierre_zeta', array('type' => 'checkbox', 'class' => '', 'label'=>array('escape'=>false, 'text'=>'<h2>Hacer Cierre Z</h2>'), 'id'=>'ArqueoHacerCierreZeta'));
                    echo $form->hidden('Zeta.id');
                    ?>
                    
                </div>

                <div class="panel-body mostrar_zeta" style="<?php echo $display ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <?php
                            echo $form->input('Zeta.total_ventas', array(
                                'type'=>'number', 
                                'label' => 'Ventas del Día', 
                                'class' => 'form-control muted')
                                    );
                            echo $form->input('Zeta.monto_neto', array('type'=>'number'));
                            echo $form->input('Zeta.nota_credito_neto', array('type'=>'number'));
                            echo $form->input('Zeta.observacion', array('label' => 'Obs. General Z'));
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $form->input('Zeta.numero_comprobante', array(
                                'type'=>'number', 
                                'step'=> '1',
                                'label' => '#Comprobante', 
                                'class' => 'form-control muted')
                                    );
                            echo $form->input('Zeta.monto_iva', array('type'=>'number'));
                            echo $form->input('Zeta.nota_credito_iva', array('type'=>'number'));
                            echo $form->input('Zeta.observacion_comprobante_tarjeta', array('label' => 'Obs. Tarjetas'));
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        echo $form->end(null);
        ?>
    </div>
</div>

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
 