<?php echo $this->element('menuadmin'); ?>


<div class="comandas index">
    <h2><?php __('Comandas'); ?></h2>

    <div class="row">
        <div class="col-md-3">
            <?php
            echo $form->create('DetalleComanda', array('url' => '/detalle_comandas/index'));
            echo $form->input('Producto.id', array('options' => $productos, 'empty' => 'Seleccionar', 'label' => 'Producto'));
            echo $form->input('Producto.categoria_id', array('options' => $categorias, 'empty' => 'Seleccionar', 'label' => 'Categoria'));
            echo $form->input('desde', array('type' => 'datetime'));
            echo $form->input('hasta', array('type' => 'datetime'));
            echo $form->end('buscar');
            ?>


            <div>
                <div class="well">
                    <h3>Principio de Pareto</h3>
                    <p>
                        En esta tabla, los productos se encuentran separados segun el <a target="_blank" href="http://es.wikipedia.org/wiki/Principio_de_Pareto">Principio de Pareto</a> del 80-20.
                        El 20% de los productos mas vendidos aparecen en <span class="text-success">color verde</span>
                        El 20% de abajo de la tabla en <span class="text-danger">color rojo</span> y son los menos vendidos
                        
                        
                    </p>
                </div>
            </div>
        </div>


        <div class="col-md-9">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Ventas (según precio actual)</th>
                        <th>Valor Porcentual En Ventas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    $leyPareto = 0;
                    foreach ($comandas as $comanda):
                        $porcentaje = ((int) (($comanda[0]['ventas'] / $ventasTotal) * 10000)) / 100;
                        $trclass = ($leyPareto > 80) ? 'danger' : '';
                        $trclass = ($leyPareto < 21) ? 'success' : $trclass;
                        ?>
                        <tr class="<?php echo $trclass ?>">
                            <td><?php echo $comanda['Producto']['name']; ?></td>
                            <td><?php echo $comanda['Producto']['precio']; ?></td>
                            <td><?php echo $comanda[0]['cant']; ?></td>
                            <td><?php echo $number->currency($comanda[0]['ventas']); ?></td>
                            <td><?php echo "%$porcentaje"; ?></td>
                        </tr>
                        <?php
                        $leyPareto += $porcentaje;
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>

    </div>


</div>

<div class="actions">
    <ul>
        <li><?php echo $html->link(__('New Comanda', true), array('action' => 'add')); ?></li>
    </ul>
</div>
