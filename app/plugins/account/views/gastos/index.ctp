
<div>

    <div class="pull-right">
        <?php echo $form->create('Gasto', array('action' => 'index')); ?>
        <?php echo $form->input('proveedor_id', array('onchange' => 'this.form.submit();', 'empty' => 'Filtrar por Proveedor', 'label' => false)) ?>
        <?php echo $form->end() ?>
    </div>
    <h1>Pendientes de Pago</h1>


</div>
<hr>
<?php echo $form->create('Egreso', array('controller' => 'egresos', 'action' => 'add')); ?>

<div class="row">
    <div class="col-md-2">
        <label for="selectall">Seleccionar Todos</label>
        <input id="selectall" type="checkbox" data-role="none"/>

    </div>

    <div class="col-md-2">
        <div id='ver-btn-crear-pago' style="display: none">
        <?php
        echo $form->submit('Pagar', array('disabled' => (count($gastos) == 0), 'class' => 'btn btn-md btn-primary', 'id' => 'btn-crear-pago'));
        ?>
        </div>
        <br>
        
    </div>
</div>


<div class="row">


    <table class="table table-hover table-responsive">

        <tbody>
            <?php
            $i = -1;
            foreach ($gastos as $gasto):
                $i++;
                ?>
                <tr>
                    <td>
                        <?php
                        echo $form->checkbox("Gasto.$i.gasto_seleccionado", array(
                            'value' => $gasto['Gasto']['id'],
                            'type' => 'checkbox',
                            'data-mini' => true,
                            'label' => false,
                            'class' => 'pull-left',
                        ));
                        ?>
                    </td>

                    <td>
                        <?php echo $gasto['TipoFactura']['name'] . ' #' . $gasto['Gasto']['factura_nro']; ?><br>
                        <?php if (!empty($gasto['Proveedor'])) { ?>
                            <small><?php echo $html->link($gasto['Proveedor']['name'], array('controller' => 'proveedores', 'action' => 'view', $gasto['Proveedor']['id']), array('data-rel' => 'dialog')); ?></small>
                        <?php } ?>
                    </td>

                    <td>
                        <?php
                        if (!empty($gasto['Gasto']['file'])) {
                            $ext = substr(strrchr($gasto['Gasto']['file'], '.'), 1);
                            if (in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
                                $iii = $html->image(THUMB_FOLDER . $gasto['Gasto']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                            } else {
                                $iii = "Descargar $ext";
                            }
                            echo $html->link($iii, "/" . IMAGES_URL . $gasto['Gasto']['file'], array('target' => '_blank', 'escape' => false));
                        }
                        ?>
                    </td>

                    <td>
                        Obs: <?php echo $gasto['Gasto']['observacion']; ?><br>
                        Clasificacion: <?php echo $gasto['Clasificacion']['name']; ?><br>
                        <?php echo date("d/m/Y", strtotime($gasto['Gasto']['fecha'])) ?>
                    </td>

                    <td>
                        <?php
                        if ($gasto['Gasto']['importe_pagado']) {
                            echo "<span style='text-decoration: line-through'>$" . $gasto['Gasto']['importe_total'] . "</span>";
                            echo " $" . ($gasto['Gasto']['importe_total'] - $gasto['Gasto']['importe_pagado']);
                        } else {
                            echo "$" . $gasto['Gasto']['importe_total'];
                        }
                        ?> 
                    </td>

                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                Action <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <?php
                                    echo $html->link(__('Pagar', true), array(
                                        'controller' => 'egresos',
                                        'action' => 'add', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $html->link(__('Ver', true), array(
                                        'action' => 'view', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $html->link(__('Editar', true), array(
                                        'action' => 'edit', $gasto['Gasto']['id']), array(
                                        'data-ajax' => 'false',
                                    ));
                                    ?>
                                </li>

                                <li>
                                    <?php
                                    echo $html->link(__('Borrar', true), array('action' => 'delete', $gasto['Gasto']['id']), array('class' => 'ajaxlink'), sprintf(__('Seguro queres borrar el # %s?', true), $gasto['Gasto']['id']));
                                    ?>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>        
        </tbody>
    </table>

</div>
<?php
echo $form->end();
?>


<script>
    (function($) {
        var $inputs = $('input[type="checkbox"]', '#EgresoAddForm');
        $('#selectall').bind('change', function(e) {
            $inputs.each(function(k, i) {
                i.checked = e.currentTarget.checked;
            });
        });

        var $btnSubmit = $("#ver-btn-crear-pago");
        $inputs.on('change', function(){
            if ( $('input[type="checkbox"]:checked', '#EgresoAddForm').length ) {
                $btnSubmit.show();
            } else {
                $btnSubmit.hide();
            }
        });
        
    })(jQuery);

</script>