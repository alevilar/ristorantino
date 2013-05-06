
<div data-role="content" >

    <div class="header-cliente">

        <a href="#mesa-view" data-direction="reverse" data-role="button" data-inline="true">Volver</a>                       

        <a id="mesa-eliminar-cliente" href="#mesa-view" data-role="button" data-inline="true" data-theme="b" data-direction="reverse">
            Borrar</span>
        </a>

    </div>

    <div>
        <?php echo $this->Form->create('Cliente') ?>
        <?php echo $this->Form->input('buscar') ?>
        <?php echo $this->Form->end() ?>
    </div>

    <div id="contenedor-listado-clientes-factura-a">

        <ul data-role="listview" id="listado-clientes">
            <li style="display: none" class="factura-a-cliente-add" data-theme="b">
                <a href="<?php echo $this->Html->url('/clientes/addFacturaA') ?>" data-rel="dialog">Agregar Nuevo Cliente</a>
            </li>
            <?php
            foreach ($clientes as $c):
                $porcentaje = !empty($c['Descuento']['porcentaje']) ? $c['Descuento']['porcentaje'] : 0;
                $tipofactura = !empty($c['Cliente']['tipofactura']) ? $c['Cliente']['tipofactura'] : 'B';
                $clienteName = !empty($c['Cliente']['nombre']) ? $c['Cliente']['nombre'] : '';
                ?>
                <li>&nbsp;
                    <a href="#mesa-view" data-direction="reverse" data-cliente='<?php echo json_encode($c['Cliente']) ?>'>
                        <?php
                        if ($c['Cliente']['tipofactura']) {
                            echo '<span>"' . $c['Cliente']['tipofactura'] . '"&nbsp;</span>';
                        }
                        echo "<span class='cliente-nrodoc'>" . $c['Cliente']['nrodocumento'] . '</span>';
                        echo '<span class="cliente-nombre">' . $c['Cliente']['nombre'] . '</span>';

                        if (!empty($c['Descuento']['porcentaje'])) {
                            echo '<span class="cliente-dto-porcentaje">%' . $c['Descuento']['porcentaje'] . ' <cite>(' . $c['Descuento']['name'] . ')</cite><span>';
                        }
                        ?>
                    </a>                   
                </li>
            <?php endforeach; ?>
        </ul>

    </div>

</div>


<script type="text/javascript">
    (function(){
        function cerrarTodo() {
            $('#listado-clientes').off('click', 'a');
            $('#mesa-eliminar-cliente').off('click');
        }
        
        
        $('#listado-clientes').on('click', 'a', function(){
            cerrarTodo();
            var c = JSON.parse( this.getAttribute('data-cliente') );
            R$.currentMesaView.model.set('cliente_id', c.id);
            R$.currentMesaView.model.set('Cliente', c);    
            R$.currentMesaView.model.save();
            
        });
    
        $('#mesa-eliminar-cliente').on('click', function(){
            cerrarTodo();
            R$.currentMesaView.model.save({'cliente_id': null, 'Cliente': {}});
        });
    })();
    
    
</script>