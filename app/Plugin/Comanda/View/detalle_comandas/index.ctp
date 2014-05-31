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
                        En esta tabla, los productos se encuentran separados según diagrama ABC del principio de pareto.<br>                      
                        <span class="text-success">Los primeros</span> productos pertenecen al 70% de las ventas<br>
                        <span class="text-warning">Los segundos</span>, al 20%<br>
                        <span class="text-danger">Por último</span>, los que pertenecen al 10%.<br>
                        <br>
                        Para mas informacion: <a href="http://www.monografias.com/trabajos47/diagrama-pareto/diagrama-pareto.shtml">ver esta monografia</a>
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
                        if ( $leyPareto < 70 ) {
                            $trclass = 'success';
                        } elseif ($leyPareto < 80) {
                            $trclass = 'warning';
                        } else {
                            $trclass = 'danger';
                        }
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
