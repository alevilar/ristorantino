<?php $this->start('jquery-tmpl'); ?>
<?php echo $this->Html->script('/adition/js/jqm_events/comanda_add'); ?>
<?php $this->end(); ?>

<div data-role="page" id="comanda-add-menu" class="comanda" data-enhance="false">
    <?php echo $this->Html->css('/adition/css/comanda_add');?>
    <div data-role="header" data-id="mesa-header" data-position="fixed">
        <a href="#mesa-view" data-rel="back" data-transition="reverse">Volver</a>
        <h1>
            <span data-bind="text: adn().currentMesa().numero()"></span>
            <?php
            echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') . " - " .
            Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png')
            ?>
            <span data-bind="text: adn().currentMesa().mozo().numero()"></span>

            <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
        </h1>

        <div data-role="controlgroup" data-type="horizontal" class="header-right-positioned">
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para desactivar la impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comandaSettings.imprimir( 0 )}, visible: adn().currentMesa().currentComanda().comandaSettings.imprimir()"><?php echo $this->Html->image('print48.png', array('class' => 'btn-comanda-icon')) ?>Si Imprime</a>
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para activar impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comandaSettings.imprimir( 1 )}, visible: !adn().currentMesa().currentComanda().comandaSettings.imprimir()" ><?php echo $this->Html->image('dontprint48.png', array('class' => 'btn-comanda-icon')) ?>No Imprime</a>
            <a style="min-width: 160px" href="#comanda-add-observacion" data-role="button" data-rel="popup" title="Agregar Observación"  onclick="if ( $('#comanda-add-observacion').is(':visible') ) { $('#comanda-add-observacion textarea').focusout();}; if ( $('#comanda-add-observacion').is(':hidden') ) { $('#comanda-add-observacion textarea').focus();}; $('#comanda-add-observacion').toggle('slow');"><?php echo $this->Html->image('pencil_48.png', array('class' => 'btn-comanda-icon')) ?>Observación</a>
            <a href="#mesa-view" data-role="button" id="comanda-add-guardar"  data-icon="check" data-theme="b">Enviar Comanda</a>
        </div>
    </div>

    <div data-role="content" data-enhance="false">
        <div id="listado_categorias">
            <?php echo $this->element('adicion_subpages/comanda_add/listar_categorias'); ?>
        </div>

        <div id="listado_productos">
            <?php echo $this->element('adicion_subpages/comanda_add/listar_productos'); ?>
        </div>

        <div id="detalle_productos">
            <?php echo $this->element('adicion_subpages/comanda_add/detalle_producto'); ?>
        </div>
    </div>    
</div>