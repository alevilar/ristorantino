<?php echo $javascript->link('listar_clientes', false); ?>


<div id="clientes-listar-container" style="float: left; width: 700px; height: 550px;">
    <div id="clientes-menu">
        <?php echo $html->link('Factura "A"','/clientes/ajax_clientes_factura_a');?>

        <?php echo $html->link('Cliente Con Descuento','/clientes/ajax_clientes_con_descuento');?>

        <?php echo $html->link('Agregar Factura "A"','/clientes/addFacturaA');?>

        <?php echo $html->link('Buscar','/clientes/ajax_buscado');?>
    </div>

    <div id="clientes-listado"></div>
</div>


