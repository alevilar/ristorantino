<?php
$ingresoEfectivo = $egresoEfectivo = null;

echo $this->Html->css('/cash/css/style_cash');

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
                        <?php foreach ($ingresosList as $ing) { ;?>
                            <tr>
                                <td>
                                    <?php echo $ing['TipoDePago']['name'] ?>
                                </td>
                                <td>
                                    <?php echo "(".$ing[0]['cant'].") ".$this->Number->currency($ing[0]['total']); ?>
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
                                    <?php echo "(".$eg[0]['cant'].") ".$this->Number->currency($eg[0]['total']); ?>
                                </td>
                            </tr>
                        <?php } ?>    
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>

    <?php echo $this->Form->button('Guardar Arqueo', array('type' => 'submit', 'class' => 'btn btn-lg btn-primary btn-block', 'id' => 'btn-submit', "form" => "ArqueoAddForm")); ?>
</div>

<div class="col-md-9">
    <div class="row">
        <?php
        echo $this->Form->create('Arqueo', array('id' => 'ArqueoAddForm'));

        echo $this->Form->input('id');

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
                                echo $this->Form->input('caja_id');
                            } else {
                                echo $this->Form->hidden('caja_id');
                            }
                            echo $this->Form->input('datetime', array('class' => "form-control muted", 'type' => 'datetime', 'label' => 'Fecha y Hora'));
                            echo $this->Form->input('importe_final', array('type' => 'number', 'required' => true));
                            echo $this->Form->input('saldo', array('disabled' => true));
                            echo $this->Form->input('observacion', array('label' => 'Obs. del Arqueo'));
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('importe_inicial', array('type' => 'number', 'class' => 'form-control muted'));
                            if (!empty($this->data['Arqueo']['ingreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_ingresos']) )) {
                                echo $this->Form->input('ingreso', array('type' => 'number', 'label' => 'Ventas en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $this->Form->hidden('ingreso');
                            }

                            if (!empty($this->data['Arqueo']['egreso']) || (!empty($caja) && !empty($caja['Caja']['name']) && !empty($caja['Caja']['computa_egresos']) )) {
                                echo $this->Form->input('egreso', array('type' => 'number', 'label' => 'Pagos en efectivo', 'class' => 'form-control muted'));
                            } else {
                                echo $this->Form->hidden('egreso');
                            }
                            echo $this->Form->input('otros_ingresos', array('type' => 'number', 'class' => 'form-control muted'));
                            echo $this->Form->input('otros_egresos', array('type' => 'number', 'class' => 'form-control muted'));
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
                    echo $this->Form->input('hacer_cierre_zeta', array('type' => 'checkbox', 'class' => '', 'label' => array('escape' => false, 'text' => '<h2>Hacer Cierre Z</h2>'), 'id' => 'ArqueoHacerCierreZeta'));
                    echo $this->Form->hidden('Zeta.id');
                    ?>

                </div>

                <div class="panel-body mostrar_zeta" style="<?php echo $display ?>">
                    <div class="row">
                        <p class="text-center">
                        <?php 
                        echo $this->Html->link("Imprimir Z", '/adition/cashier/cierre_z', array(
                            'id'=>'btn-imprimir-z', 
                            'class'=>'btn btn-success', 
                            'role'=>'buton'
                            ));
                        ?>
                        </p>
                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('Zeta.total_ventas', array(
                                'type' => 'number',
                                'label' => 'Ventas del Día',
                                'class' => 'form-control muted', 
                                'required' => false
                                )
                            );
                            echo $this->Form->input('Zeta.monto_neto', array('type' => 'number', 'required' => false));
                            echo $this->Form->input('Zeta.nota_credito_neto', array('type' => 'number'));
                            echo $this->Form->input('Zeta.observacion', array('label' => 'Obs. General Z'));
                            ?>
                        </div>

                        <div class="col-md-6">
                            <?php
                            echo $this->Form->input('Zeta.numero_comprobante', array(
                                'type' => 'number',
                                'step' => '1',
                                'label' => '#Comprobante',
                                'class' => 'form-control muted', 'required' => false
                                )
                            );
                            echo $this->Form->input('Zeta.monto_iva', array('type' => 'number'));
                            echo $this->Form->input('Zeta.nota_credito_iva', array('type' => 'number'));
                            echo $this->Form->input('Zeta.observacion_comprobante_tarjeta', array('label' => 'Obs. Tarjetas'));
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <?php
        echo $this->Form->end(null);
        ?>
    </div>
</div>

<div id="billetines" style="display: none;">
    <div class="panel panel-default">
        <div class="panel-heading">
            <a class="pull-right" href="#billetines" onclick="jQuery('#billetines').hide('fade')"><button type="button" class="close" aria-hidden="true">&times;</button></a>
            <p class="muted">Ingresar cantidades de cada billete</p>
        </div>

        <div class="panel-body">
            <form class="form-horizontal" role="form">
                <div class="form-group">
                    <label for="BilletesB100" class="col-sm-2 control-label">$100</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB100" placeholder="Billetes de $100">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB50" class="col-sm-2 control-label">$50</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB50" placeholder="Billetes de $50">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB20" class="col-sm-2 control-label">$20</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB20" placeholder="Billetes de $20">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB10" class="col-sm-2 control-label">$10</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB10" placeholder="Billetes de $10">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB5" class="col-sm-2 control-label">$5</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB5" placeholder="Billetes de $5">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB2" class="col-sm-2 control-label">$2</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB2" placeholder="Billetes de $2">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB1" class="col-sm-2 control-label">$1</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB1" placeholder="Monedas de $1">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesB0" class="col-sm-2 control-label">0.5c</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesB0" placeholder="Monedas de 50 Centavos">
                    </div>
                </div>
                <div class="form-group">
                    <label for="BilletesBA" class="col-sm-2 control-label">Otros</label>
                    <div class="col-sm-10">
                        <input type="number" class="form-control" id="BilletesBA" placeholder="Otros documentos">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php echo $this->Html->script('/cash/js/arqueos_add') ?>
 