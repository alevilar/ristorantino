
<div data-role="content" >

    <div class="header-cliente">

        <a href="#mesa-view" data-direction="reverse" data-role="button" data-inline="true">Volver</a>                       

        <a href="#mesa-view" data-role="button" id="mesa-eliminar-descuento" data-inline="true" href="#mesa-view" data-theme="b" data-direction="reverse">
            Borrar</span>
        </a>

    </div>

    <div id="contenedor-listado-descuentos">

        <ul data-role="listview"  data-filter="true" id="listado-descuentos">

            <?php
            foreach ($descuentos as $c):
                $porcentaje = !empty($c['Descuento']['porcentaje']) ? $c['Descuento']['porcentaje'] : 0;
                $nombre = $c['Descuento']['name'] . "($porcentaje%)";
                $json = "{id:" . $c['Descuento']['id'] . ", nombre: '" . $nombre . "', porcentaje: '" . $porcentaje . "'}";
                ?>
                <li>&nbsp;
                    <a href="#mesa-view" data-direction="reverse" data-descuento='<?php echo json_encode($c['Descuento'])?>'>
                        <?php echo $nombre ?>
                    </a>                   
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>

<script type="text/javascript">
    (function(){
        function cerrarTodo() {
            $('#contenedor-listado-descuentos').off('click', 'a');
            $('#mesa-eliminar-descuento').off('click');
        }
        
        
        $('#contenedor-listado-descuentos').on('click', 'a', function(){
            cerrarTodo();
            var c = JSON.parse( this.getAttribute('data-descuento') );
            R$.currentMesaView.model.set('descuento_id', c.id);
            R$.currentMesaView.model.set('Descuento', c);    
            R$.currentMesaView.model.save();
            
            
        });
    
        $('#mesa-eliminar-descuento').on('click', function(){
            cerrarTodo();
            R$.currentMesaView.model.save({'descuento_id': null, 'Descuento': {}});
        });
    })();
    
</script>