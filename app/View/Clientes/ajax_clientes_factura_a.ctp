<div data-role="header">
    <a href="#mesa-view" data-rel="back" data-transition="slide" data-direction="reverse">Volver</a>
    <h1>Clientes</h1>
    
    <div data-role="navbar">
        <ul>
            <li><? echo $this->Html->link('factura "A"','/clientes/ajax_clientes_factura_a', array( 'class'=> 'ui-btn-active')); ?></li>
            <li><? echo $this->Html->link('con descuento','/clientes/ajax_clientes_con_descuento', array()); ?></li>
            <li><? echo $this->Html->link('buscador','/clientes/ajax_buscador', array()); ?></li>
        </ul>
    </div>
</div>
    
<div data-role="content" >
    
    <div id="contenedor-listado-clientes-factura-a">
        <ul data-role="listview"  data-filter="true" id="listado-clientes-factura-a-ajax">
           
                <?php foreach($clientes as $c): ?>
                <li>
                    <a href="#mesa-view" data-transition="fade" data-direction="reverse" onclick="Risto.Adition.adicionar.currentMesa().setClienteId( <?php echo $c['Cliente']['id']; ?> )">
                        <?php echo $c['Cliente']['nrodocumento']; ?> | 
                        <?php echo $c['Cliente']['nombre']; ?>
                        <!--  <td><?php echo $c['Cliente']['domicilio']; ?> </td> -->
                    </a>                   
                </li>
                <?php endforeach; ?>
        </ul>
    </div>
</div>