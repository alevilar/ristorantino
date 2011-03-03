


<?php if (!empty($clientes)){ ?>

<?php $paginator->options(array('update' => 'listado-clientes-factura-a-ajax', 'url'=>$this->passedArgs))?>




<div id="contenedor-listado-clientes-factura-a" style="height: 540px">
    <div id="listado-clientes-factura-a-ajax">
        <table>

            <tr class="listado">

                <th><?php echo $paginator->sort('Cuit', 'nrodocumento'); ?></th>

                <th><?php echo $paginator->sort('Denominación', 'nombre'); ?></th>
                <th><?php echo $paginator->sort('Descuento', 'Descuento.porcentaje'); ?></th>

                <th>+</th>

            </tr>
            <?php foreach($clientes as $c): ?>
            <tr  class="listado">
                <td><?php echo $c['Cliente']['nrodocumento']; ?> </td>
                <td><?php echo $c['Cliente']['nombre']; ?> </td>
                <!--  <td><?php echo $c['Cliente']['domicilio']; ?> </td> -->
                <td><?php echo '%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite>'; ?> </td>
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


<?php } else {?>

<?php echo $form->create('Cliente') ?>
<?php echo $form->input('busqueda') ?>
<?php echo $ajax->submit('Buscar', array('update'=>'clientes-listado')) ?>

<?php } ?>



