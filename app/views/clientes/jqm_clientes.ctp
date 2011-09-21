    <div data-role="header">
        <h1>Clientes para la mesa <span data-bind="text: adn().currentMesa().numero"></span></h1>

        <a id="mesa-eliminar-cliente" href="#mesa-view" data-transition="fade" data-theme="b" data-direction="reverse" data-bind="visible: adn().currentMesa().Cliente()}">
                Borrar Cliente<span data-bind="text: adn().currentMesa().clienteNameData()"></span>
        </a>
        
<!--        <div data-role="navbar">
                <ul>
                    <li><a href="#" class="ui-btn-active ui-state-persist">Listado de Clientes</a></li>
                    <li><a href="<?php echo $html->url('/clientes/addFacturaA')?>">Agregar Factura "A"</a></li>
                </ul>
        </div>-->
    </div>

    <div data-role="content" >
    
    
    <div id="contenedor-listado-clientes-factura-a">
        
        <?
        debug($this->action);
        ?>
        <ul data-role="listview"  data-filter="true" id="listado-clientes-factura-a-ajax">
              
                <?php foreach($clientes as $c): 
                    $porcentaje  = !empty($c['Descuento']['porcentaje']) ? $c['Descuento']['porcentaje'] : 0;
                    $tipofactura = !empty($c['Cliente']['tipofactura'])? $c['Cliente']['tipofactura']: 'B';
                    $clienteName = !empty($c['Cliente']['nombre']) ? $c['Cliente']['nombre']: '' ;
                    ?>
            <li>&nbsp;
                    <a href="#mesa-view" data-transition="fade" data-direction="reverse" onclick="Risto.Adition.adicionar.currentMesa().setCliente( <? echo "{id:".$c['Cliente']['id'].", nombre: '".$clienteName ."', tipofactura: '$tipofactura', porcentaje: $porcentaje}";?> )">
                        <?php
                        if ($c['Cliente']['tipofactura']) {
                            echo '<span>"'.$c['Cliente']['tipofactura'].'"&nbsp;</span>';
                        }
                        echo "<span class='cliente-nrodoc'>".$c['Cliente']['nrodocumento'].'</span>';
                        echo '<span class="cliente-nombre">'.$c['Cliente']['nombre'].'</span>'; 

                        if ( !empty($c['Descuento']['porcentaje']) ) {
                            echo '<span class="cliente-dto-porcentaje">%'.$c['Descuento']['porcentaje'].' <cite>('.$c['Descuento']['name'].')</cite><span>';
                        }
                        ?>
                    </a>                   
                </li>
                <?php endforeach; ?>
        </ul>
</div>