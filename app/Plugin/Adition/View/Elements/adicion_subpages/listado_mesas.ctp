<?php echo $this->Html->script('/adition/js/jqm_events/listado_mesas'); ?>
<?php echo $this->Html->script('/adition/js/View/ListadoMesasView'); ?>

<?php $this->start('jquery-tmpl'); ?>
<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-handlebars-template">
        <a  href="#mesa-view?id={{id}}"
            data-theme="c"
            data-role="button" 
            href="#mesa-view"
            class="ui-btn ui-btn-up-c">
            <span class="mesa-span ui-btn-inner">
                <span class="ui-btn-text">
                    <span class="mesa-numero">{{numero}}</span>
                </span>
            </span>
            <span class="mesa-mozo" >{{Mozo.numero}}</span>
            <span class="mesa-descuento">{{Descuento.porcentaje}}</span>
            <span  class="mesa-tipofactura">
                {{#if Cliente.tipofactura}}
                "{{Cliente.tipofactura}}"
                {{else}}
                "B"
                {{/if}}
            </span>
            <span class="mesa-time">{{time}}</span>
        </a>
</script>



<?php $this->end(); ?>

<div data-role="page" id="listado-mesas">

    <div  data-role="header">
        <h1><span class="wow" data-bind="text: mesas().length">0</span> <?php echo Inflector::pluralize(Configure::read('Mesa.tituloMesa')) ?></h1>

        <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>

        <div data-role="navbar">
            <ul id="listado-mozos-para-mesas">
                <?php
                $anchoCalculadoPorcentual = floor(100 / (count($mozos) + 1 ));
                $anchoCalculadoPorcentualPrimero = 100 - ($anchoCalculadoPorcentual * count($mozos) );
                ?>
                <li  style="width: <?php echo $anchoCalculadoPorcentualPrimero . '%' ?>"><a href="#" class="ui-btn-active">Todos</a></li>
                <?php
                foreach ($mozos as $m) {
                    $k = $m['Mozo']['id'];
                    $n = $m['Mozo']['numero'];
                    ?>
                    <li  style="width: <?php echo $anchoCalculadoPorcentual . '%' ?>">
                        <a href="#" data-mozo-id="<?php echo $k ?>"><?php echo $n ?></a>
                    </li>
                    <?
                }
                ?>
            </ul>
        </div>
    </div>


    <div  data-role="content" class="content_mesas">           

        <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
        <a href="#mesa-add" id="mesa-abrir-mesa-btn" data-rel="dialog"  class="abrir-mesa" data-role="button" data-theme="a">Abrir<br><?php echo Configure::read('Mesa.tituloMesa') ?></a>

        <!-- @template listaMesas -->
        <div>
            <ul id="mesas_container" class="listado-adicion"></ul>
        </div>
    </div><!-- /navbar -->

</div>
<!-- Fin Pagina 1 -->
