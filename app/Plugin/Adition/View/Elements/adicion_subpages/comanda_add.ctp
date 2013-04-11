<!--
                        COMANDA-ADD

-->
<div data-role="page" id="comanda-add-menu" class="comanda">
    <div data-role="header" data-id="mesa-header" data-position="fixed">
        <a href="#mesa-view" data-rel="back" data-transition="reverse">Volver</a>
        <h1>
                <span data-bind="text: adn().currentMesa().numero()"></span>
                <?php 
                echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') ." - " .
                Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png') 
                ?>
                <span data-bind="text: adn().currentMesa().mozo().numero()"></span>
                 
                <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
        </h1>
            
        <div data-role="controlgroup" data-type="horizontal" class="header-right-positioned">
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para desactivar la impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comandaSettings.imprimir( 0 )}, visible: adn().currentMesa().currentComanda().comandaSettings.imprimir()"><?php echo $this->Html->image('print48.png', array('class'=> 'btn-comanda-icon'))?>Si Imprime</a>
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para activar impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comandaSettings.imprimir( 1 )}, visible: !adn().currentMesa().currentComanda().comandaSettings.imprimir()" ><?php echo $this->Html->image('dontprint48.png', array('class'=> 'btn-comanda-icon'))?>No Imprime</a>
            <a style="min-width: 160px" href="#comanda-add-observacion" data-role="button" data-rel="popup" title="Agregar Observación"  onclick="if ( $('#comanda-add-observacion').is(':visible') ) { $('#comanda-add-observacion textarea').focusout();}; if ( $('#comanda-add-observacion').is(':hidden') ) { $('#comanda-add-observacion textarea').focus();}; $('#comanda-add-observacion').toggle('slow');"><?php echo $this->Html->image('pencil_48.png', array('class'=> 'btn-comanda-icon'))?>Observación</a>
            <a href="#mesa-view" data-role="button" id="comanda-add-guardar"  data-icon="check" data-theme="b">Enviar Comanda</a>
        </div>
    </div>

    <div data-role="content">
        
        <input type="text" x-webkit-speech id="speach-search"/>

        <div id="searched-productos-container" style="display: none">
            <h2>Productos encontrados</h2>
            <div id="comanda-search-productos-container">
                
            </div>
        </div>
        
        <div data-role="popup" id="comanda-add-observacion" class="ui-corner-bottom ui-overlay-shadow ui-content">
            <h4 style="color: #fff">Agregar observación general para la comanda</h4>
            <textarea id="obscomandatext" style="width: 97%" data-bind="value: adn().currentMesa().currentComanda().comandaSettings.observacion, valueUpdate: 'keyup'" name="obs" class="obstext ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-a"></textarea>
            
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" onclick="" id="mesa-comanda-add-obs-gen-cancel" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a href="#" id="mesa-comanda-add-obs-gen-aceptar" data-role="button" data-theme="b">Aceptar</a></div>
            </div>
            
            <div class="observaciones-list">
                <?php foreach($observacionesComanda as $o) { ?>
                <button data-inline="true" value="<?php echo $o?>"><?php echo $o?></>
                <?php } ?>
            </div>
        </div>
        <!--        PRODUCTOS SELECCIONADOS    -->
        <div  style="width: 28%; margin-right: 2%; display: inline; float: left;">
            
           <ul id="ul-productos-seleccionados" class="ui-listview" data-role="listview"
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: adn().productosSeleccionados()}"
               style="margin-top: 8px;" ></ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">
            <div id="path" data-bind="template: {name: 'boton', foreach: menu().path()}"></div> 
            
            <?php echo $this->element('categorias_y_productos', array('categorias_sub' => $categorias)); ?>
        </div>
    </div>
        
</div>  

