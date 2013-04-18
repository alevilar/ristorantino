<?php echo $this->Html->script('/adition/js/adicion/elements/comanda_add_menu', array('inline' => 0)); ?>

<?php echo $this->Html->css('/adition/css/comanda_add_menu'); ?>

<!-- Template: Caomanda add: listado de categorias                                  -->
<script id="listaCategoriasTree" type="text/x-jquery-tmpl">
   <a  href="#" data-theme="b" data-inline="true" 
       data-bind="css: {'sin-imagen': !image_url, 'con-imagen': image_url}"
       class="">
           <image class="menu-img" data-bind="visible: image_url, attr: {src: urlDomain+'img/menu/'+image_url}"/>           
           <span data-bind="text: name"></span>
   </a>
</script>



<!-- Template: Caomanda add: listado de productos -->
<script id="categorias-productos" type="text/x-jquery-tmpl">
     <a data-bind="attr: { href: tieneSabores() ? '#page-sabores' : '#'}, css: {'producto-con-sabor': tieneSabores()}" 
        data-rel="dialog"
        data-icon="none"
        class="">
             <span class="ui-btn-text" data-bind="text: name" ></span>
     </a>
 </script>

 
 
 
 

<!--  TEmplate: Productos seleccionados en el menu. comandas add -->
<script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
    <li data-bind="visible: cant(), css:{'es-entrada': esEntrada(), 'tiene-observacion': observacion()}"  class="ui-li ui-li-static ui-body-c listado-productos-seleccionados" >
        
        <div style="display: none" data-type="horizontal" data-role="controlgroup" class="producto-seleccionado-acciones ui-corner-all ui-controlgroup ui-controlgroup-horizontal ui-options">
            <a data-bind="click: seleccionar" data-role="button" data-icon="plus" data-iconpos="notext" href="#" title="+" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-left ui-btn-up-c"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text" >+</span><span class="ui-icon ui-icon-plus ui-icon-shadow"></span></span></a>
            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">-</span><span class="ui-icon ui-icon-minus ui-icon-shadow"></span></span></a>
            <a data-bind="click: addObservacion, style: { background: observacion() ? '#437FBE' : ''}" 
               data-rel="dialog"  
               data-role="button"
               data-iconpos="notext" 
               data-icon="grid" 
               href="#comanda-add-product-obss" 
               title="Observación" 
               data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c">
                <span class="ui-btn-inner">
                    <span class="ui-btn-text">Observación
                    </span>
                    <span class="ui-icon ui-icon-grid ui-icon-shadow"></span>
                </span>
            </a>
            <a data-role="button" data-iconpos="notext" data-icon="entrada" 
               href="#" title="Entrada" data-theme="c" 
               class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"
               data-bind="click: toggleEsEntrada, css: { es_entrada: esEntrada()}"
               >
                <span class="ui-btn-inner ui-corner-right ui-controlgroup-last">
                    <span class="ui-btn-text">Entrada</span>
                    <span class="ui-icon ui-icon-entrada ui-icon-shadow"></span>
                </span>
            </a>
         </div>
        <span data-bind="text: realCant()" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
        <span data-bind="text: nameConSabores() + ' ' +observacion()"></span>
        <span class="ui-options-btn">Opciones</span>
     </li>
 </script>
 
 
 
 

<div data-role="page" id="comanda-add-menu">
    
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
    </div
    
    <div data-role="content">
        
        <div style="display: none" id="comanda-add-observacion" class="ui-corner-bottom ui-overlay-shadow ui-content">
            <h4 style="color: #fff">Agregar observación general para la comanda</h4>
            <textarea id="obscomandatext" style="width: 97%" data-bind="value: adn().currentMesa().currentComanda().comanda.observacion, valueUpdate: 'keyup'" autofocus="autofocus" name="obs" class="obstext ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-a"></textarea>
            
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
            
            <!--           SELECCION DE CATEGORIAS                           -->
           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: menu().currentSubCategorias()} ">
           </div>
           
            <!--           SELECCION DE PRODUCTOS                            -->
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: menu().currentProductos()} ">
           </div>
        </div>
    </div>
        
</div>  







<!--
                        SABORES-ADD

-->
<div data-role="page" id="page-sabores" data-theme="b" class="dialog-ancho dialog-arriba">
    <div data-role="header">
        <h1>Seleccionar sabores</h1>
               
	<a href="#" data-icon="check" data-theme="b" data-rel="back" data-bind="click: function(){adn().currentMesa().currentComanda().saveSabores()}">Guardar</a>        
    </div>

    <div data-role="content">                  
           <div id="ul-sabores" 
                data-bind="template: {name: 'listaSabores', foreach: adn().currentSabores()} ">
           </div>
    </div>
            
</div>  

