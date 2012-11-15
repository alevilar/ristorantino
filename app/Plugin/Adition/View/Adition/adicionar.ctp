<?php echo $this->element('jq_templates'); ?>
                  

<!--
                        LISTADO MESAS

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas">

	<div  data-role="header">
            <h1><span class="wow" data-bind="text: adn().mesas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?></h1>

            <a href='#adicion-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
            
            <div data-role="navbar">
                <ul id="listado-mozos-para-mesas">
                    <?php 
                    $anchoCalculadoPorcentual = floor( 100/ (count($mozos) + 1 ));
                    $anchoCalculadoPorcentualPrimero = 100 - ($anchoCalculadoPorcentual*count($mozos) );
                    ?>
                    <li  style="width: <?php echo $anchoCalculadoPorcentualPrimero.'%'?>"><a href="#" class="ui-btn-active">Todos</a></li>
                    <?php
                        foreach ($mozos as $m) {
                            $k = $m['Mozo']['id'];
                            $n = $m['Mozo']['numero'];
                            ?>
                    <li  style="width: <?php echo $anchoCalculadoPorcentual.'%'?>">
                                <a href="#" data-mozo-id="<?php echo $k?>"><?php echo $n?></a>
                            </li>
                        <?
                        }
                    ?>
                </ul>
            </div>
        </div>

                    
        <div  data-role="content" class="content_mesas">           

                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <a href="#mesa-add" id="mesa-abrir-mesa-btn" data-rel="dialog"  class="abrir-mesa" data-role="button" data-theme="a">Abrir<br><?php echo Configure::read('Mesa.tituloMesa')?></a>  

                <!-- @template listaMesas -->
                <ul id="mesas_container" class="listado-adicion" data-bind='template: { name: "listaMesas", foreach: adn().mesas }'></ul>
        </div><!-- /navbar -->

</div>
<!-- Fin Pagina 1 -->



<!-- Opciones del cajero-->
<div data-role="page" id="cajero-opciones" class="dialog-arriba">
    <div data-role="header">
        <h1>Opciones de Cajero</h1>
    </div>
    <div data-role="content">
        
            <a href="#listado-mesas" data-role="button">Modo Adicionista</a>
            
            <a href="<?php echo $this->Html->url('/adition/adicionar#listado-mesas-cerradas')?>" rel="external" data-role="button" data-icon="refresh">Refrescar Cajero</a>
            
            <h3>Informes Fiscales</h3>
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/cierre_x');?>" data-direction="reverse">Imprimir informe "X"</a></div>
                <div class="ui-block-b"><a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/cierre_z');?>" data-direction="reverse">Imprimir informe "Z"</a></div>
            </div>
            <a href="<?php echo $this->Html->url('/adition/cashier/nota_credito');?>" data-role="button">Nota de crédito</a>
            
            
            <hr />
            <h3>Impresoras</h3>
            <div data-role="fieldcontain">
                    <label for="slider">Imprime Encuesta:</label>
                    <select name="slider" id="modo-k" data-role="slider">
                            
                            <option value="0" <?php echo Configure::read('Mesa.imprimePrimeroRemito')?'':'selected="selected"'?>>No</option>
                            <option value="1" <?php echo Configure::read('Mesa.imprimePrimeroRemito')?'selected="selected"':''?>>Si</option>
                    </select> 
            </div>
            <a href="#listado-mesas-cerradas" data-role="button" data-href="<?php echo $this->Html->url('/adition/cashier/vaciar_cola_impresion_fiscal');?>" class="silent-click" >Vaciar cola de impresión</a>
            
            <hr />
            
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url('/');?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
    </div>
</div>


<!-- 
            Opciones ADICIONISTA
-->
<div data-role="page" id="adicion-opciones">
    <div data-role="header">
        <h1>Opciones</h1>
    </div>
    <div data-role="content">
        
            <a href="#listado-mesas-cerradas" data-role="button">Modo Cajero</a>
            
            <a href="<?php echo $this->Html->url('/mesas/cobradas.jqm')?>" data-role="button">Últimas Mesas Cobradas</a>
            
            <a href="<?php echo $this->Html->url('adition/adicionar')?>" rel="external" data-role="button" data-icon="refresh">Refrescar Adición</a>
            
            <a href="#" data-role="button" title="Actualizar Menú" onclick="Risto.Adition.menu.update()"><?php echo $this->Html->image('refresh.png', array('class'=> 'btn-comanda-icon'))?> Actualizar Menú</a>
            
            
            
             <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-rel="back" data-role="button">Cancelar</a></div>
                <div class="ui-block-b"><a data-icon="home" data-role="button" href="<?php echo $this->Html->url('/');?>" rel="external" data-theme="b">Ir a Página Principal</a></div>
            </div>
            
    </div>
</div>

<!--
                        LISTADO MESAS CERRADAS:::: MODO CAJERO

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas-cerradas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesasCerradas().length">0</span> <?php echo Inflector::pluralize( Configure::read('Mesa.tituloMesa') )?> Cerradas
                y <span data-bind="text: Math.abs(adn().mesasCerradas().length - adn().mesas().length)"></span> abiertas
            </h1>

            <a href='#cajero-opciones' data-icon="gear" data-rel="dialog" class="ui-btn-right">Opciones</a>
        </div>

                    
        <div  data-role="content" class="content_mesas">
                
                <!-- @template listaMesasCajero -->
                <ul id="ul-mesas-cajero" class="listado-adicion" data-bind='template: { name: "listaMesasCajero", foreach: adn().mesasCerradas }'></ul>
                
        </div><!-- /navbar -->
            
</div>
<!-- Fin Pagina Cajero -->







<!--
                        MESA-ADD

-->
<div  data-role="page"  id="mesa-add" data-theme="e" class="dialog-ancho dialog-arriba">
        <div  data-role="header"  data-position="inline">
            <h1>Abrir <?php echo Configure::read('Mesa.tituloMesa') ?></h1>
            <a href="#"  data-rel="back">Cancelar</a>
        </div>
    
        <div data-role="content">
            <form name="form-mesa-add" action="#" id="form-mesa-add" class="pasos">
                
                <div  id="add-mesa-paso1">
                    <h3 class="numero-mozo"><?php echo Inflector::pluralize( Configure::read('Mesa.tituloMozo') )?></h3>
                    <fieldset data-role="controlgroup" data-type="horizontal" style="margin: auto;">

                            <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo') ?></legend>
                            <?php
                            $first = true;
                                foreach ($mozos as $m) {
                                    $k = $m['Mozo']['id'];
                                    $n = $m['Mozo']['numero'];
                                    echo "<input type='radio' name='mozo_id' id='radio-mozo-id-$k' value='$k'/>";
                                    echo "<label for='radio-mozo-id-$k'>$n</label>";
                                }
                            ?>                     
                    </fieldset>
                </div>
                    
                <div id="add-mesa-paso2" style="display: none">
                    <fieldset data-role="fieldcontain">
                            <h3 class="numero-mesa">Número de <?php echo Configure::read('Mesa.tituloMesa') ?></h3>
                            <label for="mesa-add-numero">Ingresar el número</label>
                            <input type="number" min="1" name="numero" data-risto="mesa" id="mesa-add-numero" required="required"/>
                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button"  data-theme="c" id="add-mesa-paso2-volver">Volver</button></div>
                                <div class="ui-block-b"><button type="button"  data-theme="b" id="add-mesa-paso2-submit">Siguiente</button></div>
                            </div>

                    </fieldset>
                </div>

                <div id="add-mesa-paso3" style="display: none">
                    
                    <fieldset data-role="fieldcontain">
                        <h3 class="cubiertos">Cubiertos</h3>
                            <label for="mesa-add-cant_comensales">Ingresar la cantidad de Cubiertos</label>
                            <input type="number" name="cant_comensales" id="mesa-add-cant_comensales"/>

                            <div class="ui-grid-a">
                                <div class="ui-block-a"><button type="button"  data-theme="c" id="add-mesa-paso3-volver">Volver</button></div>

                                <div class="ui-block-b"><button type="submit"  data-theme="b" id="add-mesa-paso3-submit">Abrir <?php echo Configure::read('Mesa.tituloMesa')?></button></div>
                            </div>

                    </fieldset>
                </div>
                        
            </form>
        </div>
</div> 





<!--
                        OBSERVACIONES DE CADA PRODUCTO

-->
<div  data-role="page"  id="comanda-add-product-obss">
    <div  data-role="header"  data-position="inline">
        <h1>Observacion</h1>
        <a href="#"  data-rel="back"  onclick="$('#form-comanda-producto-observacion').submit();" data-theme="b">Guardar Observación</a>
    </div>
    <div data-role="content">
        <form name="comanda" id="form-comanda-producto-observacion">
            <textarea name="obs" id="obstext" autofocus="autofocus"></textarea>
        </form>
        
        <div class="observaciones-list">
                <?php foreach($observaciones as $o) { ?>
                <a data-role="button" data-inline="true" href="#" onclick="$('#obstext').val( $('#obstext').val()+', <?php echo $o?>' )"><?php echo $o?></a>
                <?php } ?>
        </div>
    </div>
</div> 




<!--
                        MESA_VIEW - MESA VIEW

-->
<div data-role="page" id="mesa-view">
	<div  data-role="header" data-bind="css: {'ui-bar-f': adn().currentMesa().estaCerrada()}">
            <a href="#listado-mesas" data-direction="reverse">Volver</a>
            <h1>
                <span data-bind="text: adn().currentMesa().numero()"></span>
                <?php 
                echo $this->Html->image('mesa-abrio.png') . " " . Configure::read('Mesa.tituloMesa') ." - " .
                Configure::read('Mesa.tituloMozo') . " " . $this->Html->image('mozomoniob.png') 
                ?>
                <span data-bind="text: adn().currentMesa().mozo().numero()"></span>
                 
                <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
            </h1>
        </div>

        <div  data-role="content" class="" data-scroll="true">
            
            <div class="mesa-actions">
                
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a data-role="button"id="mesa-action-comanda" href="#comanda-add-menu" data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().estado().icon}">
                                    <?= $this->Html->image('/adition/css/img/chef_64.png')?><br>
                                    Comanda
                        </a>
                    </div>
                    
                    <div class="ui-block-b">
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-cerrar_'+adn().currentMesa().estado().icon}" href="#listado-mesas" id="mesa-cerrar" data-direction="reverse">
                                    <?= $this->Html->image('/adition/css/img/cerrarmesa.png')?><br>
                                Cerrar
                        </a>
                    </div>
                </div>
                
                <div class="ui-grid-a">
                    <div class="ui-block-a">
                        <a data-role="button" id="mesa-action-cobrar" href="#mesa-cobrar" data-bind="attr: {'estado': 'mesa-cobrar_'+adn().currentMesa().estado().icon}">
                                    <?= $this->Html->image('/adition/css/img/cobrar.png')?><br>
                                Cobrar
                        </a>
                    </div>
                    
                    <div class="ui-block-b">
                        <a id="mesa-reabrir" href="#listado-mesas" data-role="button" data-bind="attr: {'estado': 'mesa-reabrir_'+adn().currentMesa().estado().icon}">
                                <?= $this->Html->image('/adition/css/img/reabrir.png')?><br>
                                Re Abrir
                        </a>
                    </div>
                </div>
                
                
                <div  data-bind="attr: {'estado': adn().currentMesa().estado().icon}" class="ui-grid-a">
                    
                    <div class="ui-block-a">
                        <a data-role="button"href="<?php echo $this->Html->url('/clientes/all_clientes.jqm')?>" data-rel="dialog" data-bind="attr: {'estado': 'mesa-cliente_'+adn().currentMesa().estado().icon}">
                                <?= $this->Html->image('/adition/css/img/customers.png')?><br>
                            <span data-bind="visible: !adn().currentMesa().Cliente()">Cliente</span>
                            <span data-bind="visible: adn().currentMesa().Cliente()" style="white-space: normal"><span data-bind="text: adn().currentMesa().clienteNameData()"></span></span>
                        </a>
                    
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-re-print_'+adn().currentMesa().estado().icon}" href="#listado-mesas" class="mesa-reimprimir"  data-rel="back">
                                <?= $this->Html->image('/adition/css/img/printer.png')?><br>
                                Imprimir Ticket
                        </a>
                        
                        <a data-role="button" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="#listado-mesas" id="mesa-borrar" data-rel="back">
                                        <?= $this->Html->image('/adition/css/img/borrarmesa.png')?><br>
                                        Borrar
                        </a>
                        
                    </div>
                    
                    <div class="ui-block-b">
                        <a data-role="button"id="mesa-action-descuento" data-bind="attr: {'estado': 'mesa-cliente_'+adn().currentMesa().estado().icon}" href="<?php echo $this->Html->url('/descuentos/all_descuentos.jqm')?>" data-rel="dialog">
                                <?= $this->Html->image('/adition/css/img/descuento.png')?><br>
                            <span>Descuento</span>
                            <span style="white-space: normal"><span data-bind="text: adn().currentMesa().Descuento().porcentaje"></span></span>
                        </a>
                        
                        
                        <a data-role="button"id="mesa-action-menu" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="#mesa-menu" data-rel="dialog">
                                        <?= $this->Html->image('/adition/css/img/menu.png')?><br>
                                         <span style="color: red" data-bind="visible: adn().currentMesa().menu() != 0,text: adn().currentMesa().menu"></span> Menú
                        </a>
                       
                        <a data-role="button" id="mesa-action-edit" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().estado().icon}" href="<? echo $this->Html->url('/mesas/edit/') ?>"  data-href="<? echo $this->Html->url('/mesas/edit/') ?>">
                                <?= $this->Html->image('/adition/css/img/editarmesa.png')?><br>
                            Editar
                        </a>

                    </div>
                </div>
                    
                <div class="ui-grid-b">
                    <div class="ui-block-a">
                        <a data-role="button"id="mesa-action-cambiar-mozo" href="#mesa-cambiar-mozo" data-rel="dialog">
                            <?= $this->Html->image('/adition/css/img/cambiarmozo.png')?><br>
                            <?php echo Configure::read('Mesa.tituloMozo')?>
                        </a>
                    </div>

                    <div class="ui-block-b">
                        <a data-role="button"id="mesa-action-cambiar-numero" href="#mesa-cambiar-numero" data-rel="dialog">
                                    <?= $this->Html->image('/adition/css/img/cambiarmesa.png')?><br>
                                    Número
                        </a>
                    </div>

                    <div class="ui-block-c">
                        <a data-role="button" id="mesa-action-cambiar-cubiertos" href="#mesa-cambiar-cubiertos" data-rel="dialog">
                            <span style="top: -19px;position: absolute;left: 50%;margin-left: -25%;" data-bind="visible: adn().currentMesa().cant_comensales() > 0"><span data-bind="text: adn().currentMesa().cant_comensales()"></span></span>
                            <?= $this->Html->image('/adition/css/img/cambiarcubiertos.png')?><br>
                            <span>Cubiertos</span>                            
                        </a>
                    </div>

                </div>
                     
            </div>

            <div class="mesa-view">
                <h3 class="titulo-comanda">Listado de Comandas</h3>

                <!-- @template listaComandas -->
                <div id="comanda-detalle-collapsible" data-role="collapsible-set"
                     data-bind="template: {name: 'listaComandas', foreach: adn().currentMesa().Comanda}"></div>
            </div>
            
        </div>
    
    <div data-role="footer" data-position="fixed">
        <h3>
            <span class="mesa-id" style="float: left;">
                    #<span data-bind="text: adn().currentMesa().id()"></span>
                    <span data-bind="visible: !adn().currentMesa().id()">
                        <?php echo $this->Html->image('loader.gif'); ?>
                    </span>
            </span>
            <span class="mesa-total"><span data-bind="text: adn().currentMesa().textoTotalCalculado()"></span></span>
            <span class="hora-abrio">Abrió a las <span data-bind="text: adn().currentMesa().timeCreated()"></span></span>
        </h3>
    </div>
</div>


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
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para desactivar la impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 0 )}, visible: adn().currentMesa().currentComanda().comanda.imprimir()"><?php echo $this->Html->image('print48.png', array('class'=> 'btn-comanda-icon'))?>Si Imprime</a>
            <a style="min-width: 160px" href="#" data-role="button" title="Haga click para activar impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 1 )}, visible: !adn().currentMesa().currentComanda().comanda.imprimir()" ><?php echo $this->Html->image('dontprint48.png', array('class'=> 'btn-comanda-icon'))?>No Imprime</a>
            <a style="min-width: 160px" href="#" data-role="button" title="Agregar Observación"  onclick="if ( $('#comanda-add-observacion').is(':visible') ) { $('#comanda-add-observacion textarea').focusout();}; if ( $('#comanda-add-observacion').is(':hidden') ) { $('#comanda-add-observacion textarea').focus();}; $('#comanda-add-observacion').toggle('slow');"><?php echo $this->Html->image('pencil_48.png', array('class'=> 'btn-comanda-icon'))?>Observación</a>
            <a href="#mesa-view" data-role="button" id="comanda-add-guardar"  data-icon="check" data-theme="b">Enviar Comanda</a>
        </div>
    </div>

    <div data-role="content" style="min-height: 300px">
        
        <input type="text" x-webkit-speech id="speach-search"/>

        <div id="searched-productos-container" style="display: none">
            <h2>Productos encontrados</h2>
            <div id="comanda-search-productos-container">
                
            </div>
        </div>
        
        <div style="display: none" id="comanda-add-observacion" class="ui-corner-bottom ui-overlay-shadow ui-content">
            <h4 style="color: #fff">Agregar observación general para la comanda</h4>
            <textarea id="obscomandatext" style="width: 97%" data-bind="value: adn().currentMesa().currentComanda().comanda.observacion, valueUpdate: 'keyup'" name="obs" class="obstext ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-a"></textarea>
            
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






<!--
                    MESA CAMBIAR MOZO

-->
<div data-role="page" id="mesa-cambiar-mozo" data-theme="e" class="dialog-ancho">
    <div data-role="header">
        <h1>Seleccionar nuevo <?php echo Configure::read('Mesa.tituloMozo')?> para la <?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero()"></span></h1>
    </div>

    <div data-role="content">           
        
        <div>
            El <?php echo Configure::read('Mesa.tituloMozo')?> actual es el <span data-bind="text: adn().currentMesa().mozo().numero"></span>
        </div>
        
        
        <form name="cambiar-mozo" id="form-cambiar-mozo" action="#" data-ajax="false"  data-direction="reverse">
            <input type="hidden" name="mesa_id" data-bind="value: adn().currentMesa().id"/>
            
            <fieldset data-role="controlgroup" data-type="horizontal">
                        <legend>Seleccionar <?php echo Configure::read('Mesa.tituloMozo')?></legend>
                        <?php
                            foreach ($mozos as $m) {
                                $k = $m['Mozo']['id'];
                                $n = $m['Mozo']['numero'];
                                echo "<input type='radio' name='mozo_id' id='radio-mozo-cambiar-id-$k' value='$k'/>";
                                echo "<label for='radio-mozo-cambiar-id-$k'>$n</label>";
                            }
                        ?>
                    </fieldset>
            
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Cambiar de <?php echo Configure::read('Mesa.tituloMozo') ?></button></div>
	    </fieldset>
        </form>
    </div>
            
</div>  





<!--
                    MESA CAMBIAR NUMERO

-->
<div data-role="page" id="mesa-cambiar-numero" data-theme="e">
    <div data-role="header">
        <h1>Cambiar número de la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().numero"></span></h1>
    </div>

    <div data-role="content">    
        <p>
        El número actual es <span data-bind="text: adn().currentMesa().numero"></span>
        </p>
        <form name="cambiar-mozo" id="form-cambiar-numero" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nuevo número</label>
                <input type="number" name="numero" id="numeroacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
</div>  




<!--
                    MESA CAMBIAR CUBIERTOS

-->
<div data-role="page" id="mesa-cambiar-cubiertos" data-theme="e">
    <div data-role="header">
        <h1>Cambiar cubiertos de la <?php echo Configure::read('Mesa.tituloMesa') ?> <span data-bind="text: adn().currentMesa().cant_comensales"></span></h1>
    </div>

    <div data-role="content">    
        <p>
        La cantidad de cubiertos actuales es <span data-bind="text: adn().currentMesa().cant_comensales"></span>
        </p>
        <form name="cambiar-cubiertos" id="form-cambiar-cubiertos" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nueva cantidad</label>
                <input type="number" name="numero" id="numeroacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
</div>  







<!--
                    MESA MENU

-->
<div data-role="page" id="mesa-menu" data-theme="e">
    <div data-role="header">
        <h1>Seleccionar cantidad de Menú</h1>
    </div>

    <div data-role="content">    
        <p>
        La cantidad de menú actual es <span data-bind="text: adn().currentMesa().menu"></span>
        </p>
        <form name="cambiar-menu" action="#mesa-view" data-ajax="false"  data-transition="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <label for="numeroacambiar">Ingresar nuevo número</label>
                <input type="number" name="menu" id="menuacambiar" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Modificar</button></div>
	    </fieldset>
            
        </form>
    </div>
            
</div>  




<!--
                    MESA COBRAR

-->
<div data-role="page" id="mesa-cobrar" data-theme="e">
    <div data-role="header">
        <h1><?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero()"></span> | <span data-bind="text: adn().vueltoText()"></span></h1>
        <a data-icon="back" href="#mesa-view" data-direction="reverse" data-theme="e">Ir a la <?php echo Configure::read('Mesa.tituloMesa')?></a>
    </div>

    <div data-role="content">                  
        <h2>Cobrar la <?php echo Configure::read('Mesa.tituloMesa')?> <span data-bind="text: adn().currentMesa().numero"></span> <span class="mesa-total" style="float: right; color: red;">Total $<span data-bind="text: adn().currentMesa().total()"></span></span></h2>
        
        <ul class="tipo_de_pagos">
        <?php 
        foreach ( $tipo_de_pagos as $tp ){
            $pago = $tp['TipoDePago'];
            $pagoJson =  json_encode($pago);
            ?>
            <li>
                <a href="#" onclick='new Risto.Adition.pago(<?php echo $pagoJson?>)'>
            <?php
            echo $this->Html->image($tp['TipoDePago']['image_url']);
            echo '<br />';
            echo $pago['name'];
            ?>
                </a>
                </li>
                <?php
        }
        ?>
        </ul>
        
        <h4>Pagos Seleccionados <span style="float: right; font-size: 24px; color: #003366">Vuelto: $<span data-bind="text: adn().vuelto()"></span></span></h4>
        <ul class="pagos_creados"
            data-bind='template: { name: "li-pagos-creados", foreach: adn().pagos }'>
        </ul>
        
            <div class="ui-grid-c">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-icon="back">Cancelar</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-rel="back" data-icon="back" id="mesa-cajero-reabrir">Re Abrir</a></div>
                <div class="ui-block-c"><a href="#" data-role="button" class="mesa-reimprimir">Imprimir Ticket</a></div>
                <div class="ui-block-d"><a href="#" data-role="button" data-rel="back" data-theme="b" id="mesa-pagos-procesar">Cobrar</a></div>
	    </div>
    </div>
    
            
</div>  

