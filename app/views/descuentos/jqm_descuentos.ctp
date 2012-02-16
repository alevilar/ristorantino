
        <div data-role="content" >

                    <div class="header-cliente">

                        <a href="#mesa-view" data-direction="reverse" data-role="button" data-inline="true">Volver</a>                       

                        <a href="#mesa-view" data-role="button" id="mesa-eliminar-descuento" data-inline="true" href="#mesa-view" data-theme="b" data-direction="reverse" data-bind="visible: adn().currentMesa().Descuento()}">
                                Borrar</span>
                        </a>

                    </div>

                    <div id="contenedor-listado-descuentos">

                        <ul data-role="listview"  data-filter="true" id="listado-descuentos">
                            
                                <?php foreach($descuentos as $c): 
                                    $porcentaje  = !empty($c['Descuento']['porcentaje']) ? $c['Descuento']['porcentaje'] : 0;
                                    $nombre = $c['Descuento']['name'] . "($porcentaje%)";
                                    $json = "{id:".$c['Descuento']['id'].", nombre: '".$nombre."', porcentaje: '".$porcentaje."'}";
                                    ?>
                            <li>&nbsp;
                                    <a href="#mesa-view" data-direction="reverse" onclick="Risto.Adition.adicionar.currentMesa().setDescuento(<? echo $json; ?>)">
                                        <?php echo $nombre?>
                                    </a>                   
                                </li>
                                <?php endforeach; ?>
                        </ul>

                    </div>
                    
        </div>
    