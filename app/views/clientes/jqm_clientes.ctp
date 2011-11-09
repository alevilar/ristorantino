<style>
    .header-cliente{
        text-align: center;
        height: 80px;
    }
    
    .header-cliente h4{
        display: inline-block;
        width: 200px;
        top: -12px;
        position: relative;
    }
</style>    
<div data-role="content" >
        
        <div class="header-cliente">
        
            <a href="#" data-rel="back" data-role="button" data-inline="true">Volver</a>

            <h4>Seleccionar Cliente</h4>

            <a data-role="button" id="mesa-eliminar-cliente" data-inline="true" href="#mesa-view" data-transition="fade" data-theme="b" data-direction="reverse" data-bind="visible: adn().currentMesa().Cliente()}">
                    Borrar Cliente</span>
            </a>

        </div>
        
    <div id="contenedor-listado-clientes-factura-a">
        
        <ul data-role="listview"  data-filter="true" id="listado-clientes-factura-a-ajax">
            <li style="display: none" class="factura-a-cliente-add" data-theme="b">
                <a href="<?php echo $html->url('/clientes/addFacturaA') ?>" data-rel="dialog">Agregar Nuevo Cliente</a>
            </li>
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