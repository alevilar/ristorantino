<div data-role="header">
    <a href="#mesa-view" data-transition="slide" data-direction="reverse">Volver</a>
    <h1>Clientes para la mesa <span data-bind="text: adn().currentMesa().numero"></span></h1>
</div>
    
<div data-role="content" >
    
    
    <div id="contenedor-listado-clientes-factura-a">
        <ul data-role="listview"  data-filter="true" id="listado-clientes-factura-a-ajax">
           
                <?php foreach($clientes as $c): ?>
            <li>&nbsp;
                    <a href="#mesa-view" data-transition="fade" data-direction="reverse" onclick="Risto.Adition.adicionar.currentMesa().setClienteId( <?php echo $c['Cliente']['id']; ?> )">
                        <?php
                        if ($c['Cliente']['tipofactura']) {
                            echo '<span>"'.$c['Cliente']['tipofactura'].'"&nbsp;</span>';
                        }
                        echo "<span class='cliente-nrodoc'>".$c['Cliente']['nrodocumento'].'</span>';
                        echo '<span class="cliente-nombre">'.$c['Cliente']['nombre'].'</span>'; 

                        if ( !empty($c['Descuento']['porcentaje']) ){
                            echo '<span class="cliente-dto-porcentaje">%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite><span>';
                        }
                        ?>
                    </a>                   
                </li>
                <?php endforeach; ?>
        </ul>
    </div>
</div>