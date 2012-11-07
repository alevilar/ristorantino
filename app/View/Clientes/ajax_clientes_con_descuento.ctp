<div data-role="header">
    <h1>Clientes</h1>
    
    <div data-role="navbar">
        <ul>
            <li><? echo $this->Html->link('factura "A"','/clientes/ajax_clientes_factura_a', array('data-rel'=>'dialog')); ?></li>
            <li><? echo $this->Html->link('con descuento','/clientes/ajax_clientes_con_descuento', array('data-rel'=>'dialog', 'class'=> 'ui-btn-active')); ?></li>
            <li><? echo $this->Html->link('buscador','/clientes/ajax_buscador', array('data-rel'=>'dialog')); ?></li>
        </ul>
    </div>
</div>
    
<div data-role="content" >
   
        
        
    <?php $this->Paginator->options()?>

    <div id="contenedor-listado-clientes">
        <div id="listado-clientes-ajax">
            <table>
                <tr class="listado">
                    <th><?php echo $this->Paginator->sort('Nombre', 'Cliente.nombre'); ?></th>
                    <th><?php echo $this->Paginator->sort('Descuento', 'Descuento.porcentaje'); ?></th>
                    <th>+</th>
                </tr>
                <?php foreach($clientes as $c): ?>
                <tr  class="listado">
                    <td><?php echo $c['Cliente']['nombre']; ?> </td>
                    <td><?php echo '%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite>'; ?> </td>
                    <td><a href="#AgregarCliente" onclick="agregarClienteACurrentMesa(<?php echo $c['Cliente']['id'];?>)">ADD</a></td>
                </tr>
                <?php endforeach; ?>
            </table>


            <div id="listado-clientes-paginador"  class="menu-horizontal">
                <ul>
                    <!-- Muestra los enlaces para Anterior -->
                    <li><?php echo $this->Paginator->prev('« - ', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>

                    <!-- Muestra los números de página -->
                    <?php echo $this->Paginator->numbers(array('tag'=>'li','class'=>'boton')); ?>

                    <!-- Muestra los enlaces para Siguiente -->
                    <li><?php echo $this->Paginator->next(' + »', array('class' => 'boton'), null, array('class' => 'disabled boton'));?></li>

                    <!-- Muestra X de Y, donde X es la página actual e Y el total del páginas -->
                    <?php // echo $this->Paginator->counter(); ?>
                </ul>
            </div>
        </div>
    </div>

</div>