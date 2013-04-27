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
            <span class="mesa-cliente">{{cliente_abr}}</span>
            
            <span class="mesa-time mesa-time-abrio">{{time_abrio_abr}}</span>
            <span class="mesa-time mesa-time-cerro">{{time_cerro_abr}}</span>
        </a>
</script>

<script id="tmp-lista-mesas-header" type="text/x-handlebars-template">
    <span class="wow">{{length}}</span>
</script>

<?php echo $this->Html->script('/adition/js/View/ListadoMesasView'); ?>
<?php echo $this->Html->script('/adition/js/View/ItemListadoMesasView'); ?>
<?php echo $this->Html->script('/adition/js/jqm_events/listado_mesas'); ?>

<?php $this->end(); ?>

<div data-role="page" id="listado-mesas">

    <header  data-role="header">
        <h1><span class="wow cant_mesas">0</span> <?php echo Inflector::pluralize(Configure::read('Mesa.tituloMesa')) ?></h1>

        <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>

        <div class="ui-navbar ui-mini">
            <ul id="listado-mozos-para-mesas">
                <?php
                $anchoCalculadoPorcentual = 100 / count($mozos);
                ?>

                <?php
                foreach ($mozos as $m) {
                    $k = $m['Mozo']['id'];
                    $n = $m['Mozo']['numero'];
                    ?>
                 <li  style="width: <?php echo $anchoCalculadoPorcentual . '%' ?>">
                    <a href="#mesa-add?mozo=<?php echo $k ?>" id="mesa-abrir-mesa-btn" class="btn-mozo ui-btn ui-btn-inline ui-btn-up-a" data-rel="dialog">
<!--                    <a href="#mesa-add?mozo=<?php echo $k ?>"  data-corners="false" data-shadow="false" data-iconshadow="true" data-wrapperels="span" data-theme="a" data-inline="true">-->
                    <span class="ui-btn-inner">
                        <span class="ui-btn-text"><?php echo $n ?></span>
                    </span>
                    </a>
                </li>
                    <?
                }
                ?>
            </ul>
        </div>
    </header>


    <div  data-role="content" class="content_mesas">           
        <!-- @template listaMesas -->
        <div>
            <?php
                foreach ($mozos as $m) {
                    $k = $m['Mozo']['id'];
                    $n = $m['Mozo']['numero'];
                    ?>
            <div class="mesas_mozo"  style="width: <?php echo $anchoCalculadoPorcentual . '%' ?>">
                <ul id="mesas_container_mozo_<?php echo $k ?>">
                </ul>
                &nbsp;
            </div>
              <?
                }
                ?>
        </div>
    </div><!-- /navbar -->

</div>
