
<h1>Viendo detalle del Cierre <small><cite>"<?php echo $cierre['Cierre']['name'] ?>"</cite></small></h1>

<p>
    creado: <?php echo date('d-m-Y H:i', strtotime($cierre['Cierre']['created'])); ?>
</p>

<h3>Listado de los Gastos que entraron en este cierre</h3>


<table class="table table-hover table-responsive">
    <thead>
        <tr>
            <th>Factura</th>
            <th>&nbsp;</th>
            <th>Detalles</th>
            <th>Neto</th>
            <th>Total</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>



        <?php
        $i = -1;
        foreach ($cierre['Gasto'] as $gasto):
            $i++;
            ?>
            <tr>

                <td>
                    <?php echo $gasto['TipoFactura']['name'] . ' #' . $gasto['factura_nro']; ?><br>
                    <?php if (!empty($gasto['Proveedor'])) { ?>
                    <small><?php echo $html->link($gasto['Proveedor']['name'], array('controller' => 'proveedores', 'action' => 'view', $gasto['Proveedor']['id']), array('data-rel' => 'dialog')); ?></small>
                    <?php } ?>
                </td>

                <td>
                    <?php
                    if (!empty($gasto['file'])) {
                        $ext = substr(strrchr($gasto['file'], '.'), 1);
                        if (in_array(low($ext), array('jpg', 'png', 'gif', 'jpeg'))) {
                            $iii = $html->image(THUMB_FOLDER . $gasto['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                        } else {
                            $iii = "Descargar $ext";
                        }
                        echo $html->link($iii, "/" . IMAGES_URL . $gasto['file'], array('target' => '_blank', 'escape' => false));
                    }
                    ?>
                </td>

                <td>
                    Obs: <?php echo $gasto['observacion']; ?><br>
                    Clasificacion: <?php echo $gasto['Clasificacion']['name']; ?><br>
                    <?php echo date("d/m/Y", strtotime($gasto['fecha'])) ?>
                </td>

                <td>
                    <?php
                    echo $gasto['importe_neto'];
                    ?> 
                </td>
                
                <td>
                    <?php
                    echo $gasto['importe_total'];
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
                                    'action' => 'add', $gasto['id']), array(
                                    'data-ajax' => 'false',
                                ));
                                ?>
                            </li>

                            <li>
                                <?php
                                echo $html->link(__('Ver', true), array(
                                    'action' => 'view', $gasto['id']), array(
                                    'data-ajax' => 'false',
                                ));
                                ?>
                            </li>

                            <li>
                                <?php
                                echo $html->link(__('Editar', true), array(
                                    'action' => 'edit', $gasto['id']), array(
                                    'data-ajax' => 'false',
                                ));
                                ?>
                            </li>

                            <li>
                                <?php
                                echo $html->link(__('Borrar', true), array('action' => 'delete', $gasto['id']), array('class' => 'ajaxlink'), sprintf(__('Seguro queres borrar el # %s?', true), $gasto['id']));
                                ?>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>        
    </tbody>
</table>
