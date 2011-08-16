<div data-role="header">
    <h1>Clientes</h1>
    
    <div data-role="navbar">
        <ul>
            <li><? echo $html->link('factura "A"','/clientes/ajax_clientes_factura_a', array('data-rel'=>'dialog', 'class'=> 'ui-btn-active')); ?></li>
            <li><? echo $html->link('con descuento','/clientes/ajax_clientes_con_descuento', array('data-rel'=>'dialog')); ?></li>
            <li><? echo $html->link('buscador','/clientes/ajax_buscador', array('data-rel'=>'dialog')); ?></li>
        </ul>
    </div>
</div>
    
<div data-role="content" >
    
    <?php $paginator->options()?>
    <div id="contenedor-listado-clientes-factura-a" style="height: 540px">
        <div id="listado-clientes-factura-a-ajax">
            <table>

                <tr class="listado">

                    <th><?php echo $paginator->sort('Cuit', 'nrodocumento'); ?></th>

                    <th><?php echo $paginator->sort('Denominación', 'nombre'); ?></th>

                    <th>+</th>

                </tr>
                <?php foreach($clientes as $c): ?>
                <tr  class="listado">
                    <td><?php echo $c['Cliente']['nrodocumento']; ?> </td>
                    <td><?php echo $c['Cliente']['nombre']; ?> </td>
                    <!--  <td><?php echo $c['Cliente']['domicilio']; ?> </td> -->
                    <td><a href="#AgregarCliente" onclick="agregarClienteACurrentMesa(<?php echo $c['Cliente']['id'];?>)">ADD</a></td>
                </tr>
                <?php endforeach; ?>
            </table>


            <div id="listado-clientes-factura-a-paginador" class="menu-horizontal">
                <ul>
                    <!-- Muestra los enlaces para Anterior -->
                    <li><?php echo $paginator->prev('« - ', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>

                    <!-- Muestra los números de página -->
                    <?php echo $paginator->numbers(array('tag'=>'li','class'=>'boton', 'modulus'=>'5')); ?>

                    <!-- Muestra los enlaces para Siguiente -->
                    <li><?php echo $paginator->next(' + »', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>

                    <!-- Muestra X de Y, donde X es la página actual e Y el total del páginas -->
                    <?php // echo $paginator->counter(); ?>
                </ul>
            </div>

        </div>
    </div>
</div>