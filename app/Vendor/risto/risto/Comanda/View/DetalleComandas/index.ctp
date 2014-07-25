

<div class="comandas index">
    <h2><?php __('Comandas'); ?></h2>

    <div class="row">
        <div class="col-md-3">
            <?php
            echo $this->Form->create('DetalleComanda');

            echo $this->Form->input('cant_o_tot', array('type' => 'radio', 'options'=>array('Calculo por Ventas', 'Calculo por Unidades'), 'default'=>0, 'label'=>false));

            echo $this->Form->input('producto_id', array(
                'options' => $productos, 
                'label' => false,  
                'required' => false, 
                'empty' => 'Seleccione Producto'));

            echo $this->Form->input('categoria_id', array('options' => $categorias, 'empty' => 'Seleccionar', 'label' => false, 'multiple' => true, 'style'=>'width: 100%; height: 135px;'));

            echo $this->Form->input('desde', array('type' => 'text', 'placeholder'=>'Fecha Desde. Formato: YYYY-MM-DD', 'label'=>false));

            echo $this->Form->input('hasta', array('type' => 'text', 'placeholder'=>'Fecha Hasta. Formato: YYYY-MM-DD', 'label'=>false));
            
            echo $this->Form->submit('buscar', array('class'=>'btn btn-success btn-block'));
            echo $this->Form->end();
            ?>

            <br>
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
                            <td><?php echo $this->Number-> currency($comanda[0]['ventas']); ?></td>
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
        <li><?php echo $this->Html->link(__('New Comanda', true), array('action' => 'add')); ?></li>
    </ul>
</div>
