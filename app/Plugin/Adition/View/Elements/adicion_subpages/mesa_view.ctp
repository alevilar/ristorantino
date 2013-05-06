<?php $this->start('jquery-tmpl'); ?>
<!-- Template: listado de comandas con sus productos-->
<script id="listaComandas" type="text/x-handlebars-template">
    <div data-role="collapsible" data-content-theme="c">
        <h3>
            <span class="id-comanda">#<span></span></span>  <span class="hora-comanda"></span>&nbsp;&nbsp;&nbsp;
            <span class="comanda-listado-productos-string"></span>

            <a style="float: right;" href="#" class="btn-comanda-icon">
                imprimir
            </a>
        </h3>

        <!-- @template li-productos-detallecomanda -->
        <ul class="comanda-items" data-role="listview" style="margin: 0px;"></ul>                                                                           
    </div>
</script>

<script id="mesaLoader" type="text/x-handlebars-template">
    <span class="mesa-loader">
        <?php echo $this->Html->image('loader.gif'); ?>
    </span>
</script>



<!-- Template: Listado de productos del detalle Comanda -->
<script id="li-productos-detallecomanda" type="text/x-handlebars-template">
    <li class="ui-li ui-li-static ui-btn-up-c ui-li-last">
        <div data-type="horizontal"  data-mini="true" data-role="controlgroup" style="float: left">
            <a id="mesa-action-detalle-comanda-sacar-item" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c">-</a>
            <a data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c">
                Entrada
            </a>
        </div>

        <span class="producto-cant"  style="padding-left: 20px;"></span>
        <span class="producto-nombre" style="padding-left: 20px;"></span>
        <span class="producto-precio">p/u: {{= '$'}}<span></span></span>
    </li>
</script>


<?php echo $this->Html->script('/adition/js/View/MesaView'); ?>

<?php $this->end(); ?>



<div data-role="page" id="mesa-view">
    <header data-role="header">
        <a href="#" data-rel="back" data-direction="reverse">Volver</a>
        <h1 class="header">
            <span class="mesa-numero"></span>
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') . " - " .
            Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png')
            ?>
            <span class="mozo-numero"></span>

            <span class="mesa-estado">Abierta</span>

        </h1>
    </header>

    <div  data-role="content" class="" data-scroll="true">

        <div class="mesa-actions">

            <a id="btn-mesa-comanda" href="#comanda-add-menu" data-role="button">
                Comanda
            </a>

            <a id="btn-mesa-cerrar" href="mesas/cerrarMesa" data-direction="reverse" data-role="button">
                Cerrar
            </a>

            <a id="btn-mesa-cobrar" href="#mesa-cobrar" data-role="button">
                Cobrar
            </a>

            <a id="btn-mesa-reabrir" href="mesas/reabrir" data-direction="reverse" data-role="button">
                Re Abrir
            </a>


            <a id="btn-mesa-clientes" href="<?php echo $this->Html->url('/clientes/all_clientes') ?>" data-rel="dialog" data-role="button">
                <span>Cliente</span>
            </a>

            <a id="btn-mesa-descuento" href="<?php echo $this->Html->url('/descuentos') ?>" data-rel="dialog" data-role="button">
                <span>Descuento</span>
            </a>


            <a id="btn-mesa-ticket" href="mesas/imprimirTicket" data-direction="reverse" data-role="button">
                Imprimir Ticket
            </a>

            <a id="btn-mesa-borrar" href="#listado-mesas" data-direction="reverse" data-role="button">
                Borrar
            </a>




            <a id="btn-mesa-menu" href="#mesa-menu" data-rel="dialog" data-role="button">
                <span style="color: red"></span> Menú
            </a>

            <a  id="btn-mesa-edit" href="<? echo $this->Html->url('/mesas/edit/') ?>" data-role="button">
                Editar
            </a>

            <a id="btn-mesa-mozo" href="#mesa-cambiar-mozo" data-role="button">
                <?php echo Configure::read('Mesa.tituloMozo') ?>
            </a>

            <a id="btn-mesa-numero" href="#mesa-cambiar-numero" data-rel="dialog" data-role="button">
                Número
            </a>

            <a id="btn-mesa-cubiertos" href="#mesa-cambiar-cubiertos" data-rel="dialog" data-role="button">
                <span>Cubiertos</span>                            
            </a>
        </div>

    </div>

    <div class="mesa-view">
        <h3 class="titulo-comanda">Listado de Comandas</h3>

        <!-- @template listaComandas -->
        <div id="comanda-detalle-collapsible" data-role="collapsible-set"></div>
    </div>


    <footer data-role="footer" data-position="fixed">
        <h3>
            <span class="mesa-id" style="float: left;">
                #<span class="mesa_id"></span>
            </span>
            <span class="mesa-total"></span>
            <span class="hora-abrio"></span>
        </h3>
    </footer>
</div>