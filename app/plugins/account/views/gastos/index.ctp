<div style="text-align: center">
    <?php echo $form->create('Gasto', array('action' => 'index')); ?>
    <?php echo $form->input('proveedor_id', array('onchange' => 'this.form.submit();', 'empty' => 'Filtrar por Proveedor', 'label' => false)) ?>
    <?php echo $form->end() ?>
</div>

<br><br>

<div class="gastos index">

    <?php echo $form->create('Egreso', array('controller' => 'egresos', 'action' => 'add')); ?>

    <ul data-role="listview"  class="listado-gastos">
        <?php
        $i = 0;
        foreach ($gastos as $gasto):
            $class = null;
            if ($i++ % 2 == 0) {
                $class = ' class="altrow"';
            }
            ?>

            <li<?php echo $class; ?> id="<?php echo "gasto-" . $gasto['Gasto']['id']; ?>">  
                <div>
                    <h1><?php echo $gasto['TipoFactura']['name'] . ' #' . $gasto['Gasto']['factura_nro']; ?></h1>
                    <h2><?php echo $html->link($gasto['Proveedor']['name'], array('controller' => 'proveedores', 'action' => 'view', $gasto['Proveedor']['id']), array('data-rel' => 'dialog')); ?></h2>


                    <div style="position: absolute; right: 3px;">
                        <?php
                        if (!empty($gasto['Gasto']['file'])) {
                            $iii = $html->image($gasto['Gasto']['file'], array('width' => 48, 'alt' => 'Bajar', 'escape' => false));
                            echo $html->link($iii, "/" . IMAGES_URL . $gasto['Gasto']['file'], array('target' => '_blank', 'escape' => false));
                        }
                        ?>
                    </div>

                    <p>
                        Obs: <?php echo $gasto['Gasto']['observacion']; ?><br>
                        Clasificacion: <?php echo $gasto['Clasificacion']['name']; ?><br>
                        <?php echo date("d/m/Y", strtotime($gasto['Gasto']['fecha'])) ?>
                    </p>
                    <h4>
                        <?php
                        if ($gasto['Gasto']['importe_pagado']) {
                            echo "<span style='text-decoration: line-through'>$" . $gasto['Gasto']['importe_total'] . "</span>";
                            echo " $" . ($gasto['Gasto']['importe_total'] - $gasto['Gasto']['importe_pagado']);
                        } else {
                            echo "$" . $gasto['Gasto']['importe_total'];
                        }
                        ?>                        
                    </h4>
                    <p>
                        <?php
                        $j = $i - 1;
                        echo $form->input("Gasto.$j.gasto_seleccionado", array(
                            'value' => $gasto['Gasto']['id'],
                            'type' => 'checkbox',
                            'data-mini' => true,
                            'label' => 'Seleccionar Gasto'
                        ));
                        ?>
                        <?php
                        echo $html->link(__('Ver', true), array(
                            'action' => 'view', $gasto['Gasto']['id']), array(
                            'data-ajax' => 'false',
                        ));

                        echo " - ";

                        echo $html->link(__('Editar', true), array(
                            'action' => 'edit', $gasto['Gasto']['id']), array(
                            'data-ajax' => 'false',
                        ));
                        ?>

                    </p>
                </div>
            </li>
<?php endforeach; ?>        
    </ul>

    <div style="clear: both"></div>
<?php
echo $form->submit('Nuevo egreso', array('disabled' => (count($gastos) == 0)));
echo $form->end();
?>

</div>
