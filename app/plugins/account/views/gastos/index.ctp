    

    <?php echo $html->link(__('Crear Nuevo gasto', true), array('controller' => 'gastos', 'action' => 'add'), array('data-role' => 'button', 'data-icon' => 'plus', 'data-inline' => 'true', 'data-theme' => 'b')); ?>


    <br><br>
    <?php
    echo $javascript->link(array(
        'account/gastos_index',
    ));
    ?>

    <div class="gastos index">

        <?php echo $form->create('Egreso'); ?>
        
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
                    <h1><?php echo $gasto['TipoFactura']['name'].' #'.$gasto['Gasto']['factura_nro']; ?></h1>
                    <h2><?php echo $html->link($gasto['Proveedor']['name'], array('controller' => 'proveedores', 'action' => 'view', $gasto['Proveedor']['id']), array('data-rel' => 'dialog')); ?></h2>
                    
                    <p>
                        Obs: <?php echo $gasto['Gasto']['observacion']; ?><br>
                        Clasificacion: <?php echo $gasto['Clasificacion']['name']; ?><br>
                        <?php echo date("d/m/Y", strtotime($gasto['Gasto']['fecha']))?>
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
                         <?php echo $html->link(__('Edit', true), array('action' => 'edit', $gasto['Gasto']['id'])); ?>
                          
                    </p>
                    </div>
                </li>
            <?php endforeach; ?>        
        </ul>

        <div style="clear: both"></div>
        <?php
        echo $form->end('Nuevo egreso');
        ?>
        
    </div>
    