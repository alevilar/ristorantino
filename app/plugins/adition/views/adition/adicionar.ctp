<?php echo $this->element('jq_templates'); ?>
                  
                                         
<!--
                        LISTADO MESAS

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesas().length">0</span> Mesas</h1>

            <a rel="external" href='#listado-mesas' data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>

            <div data-role="navbar">
                <ul class="listado-mozos-para-mesas">
                    <li><a href="#" onclick="$('#mesas_container li').show();" class="ui-btn-active">Todos</a></li>
                    <?php
                        foreach ($mozos as $m) {
                            $k = $m['Mozo']['id'];
                            $n = $m['Mozo']['numero'];
                            ?>
                            <li><a href="#" data-mozo-id="<?php echo $k?>"><?php echo $n?></a></li>
                        <?
                        }
                    ?>
                </ul>
            </div>
        </div>

                    
        <div  data-role="content" class="content_mesas">           

                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <a href="#mesa-add" data-rel="dialog"  data-transition="none" class="grid_1 abrir-mesa" href="#" data-role="button" data-theme="a">Abrir<br>Mesa</a>  
                <ul id="mesas_container" class="listado-adicion" data-bind='template: { name: "listaMesas", foreach: adn().mesas }'>
                        
                </ul>
        </div><!-- /navbar -->
            
        <div  data-role="footer" data-position="fixed">
                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mesas" class="ui-btn-active ui-state-persist">Modo Adicionista</a></li>
                            <li><a href="#listado-mesas-cerradas">Modo Cajero</a></li>
                        </ul>
                </div>
        </div>

</div>
<!-- Fin Pagina 1 -->



<!-- Opciones del cajero-->
<div data-role="page" id="cajero-opciones">
    <div data-role="header">
        <h1>Opciones de Cajero</h1>
    </div>
    <div data-role="content">
            <h3>Informes Fiscales</h3>
            <a href="#listado-mesas-cerradas" data-href="<?php echo $html->url('/adition/cashier/cierre_x');?>" data-direction="reverse" data-transition="slide" data-inline="true" data-role="button">Imprimir informe "X"</a>
            <a href="#listado-mesas-cerradas" data-href="<?php echo $html->url('/adition/cashier/cierre_z');?>" data-direction="reverse" data-transition="slide" data-inline="true" data-role="button">Imprimir informe "Z"</a>
            <a href="<?php echo $html->url('/adition/cashier/nota_credito');?>" data-transition="slide" data-inline="true" data-role="button">Nota de crédito</a>
            
            <hr />
            <h3>Impresoras</h3>
            <a href="#listado-mesas-cerradas" data-href="<?php echo $html->url('/adition/cashier/vaciar_cola_impresion_fiscal');?>" data-inline="true" data-role="button" class="silent-click" >Vaciar cola de impresión</a>
            
            <hr />
            <h3>Servidor</h3>
            <a data-icon="home" href="<?php echo $html->url('/');?>" data-inline="true" rel="external" data-role="button">Volver a HOME</a>
    </div>
</div>

<!--
                        LISTADO MESAS CERRADAS:::: MODO CAJERO

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas-cerradas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesasCerradas().length">0</span> Mesas Cerradas
                y <span data-bind="text: Math.abs(adn().mesasCerradas().length - adn().mesas().length)"></span> abiertas
            </h1>

            <a href='#cajero-opciones' data-icon="gear" data-iconpos="notext" data-rel="dialog" class="ui-btn-right">Home</a>
        </div>

                    
        <div  data-role="content" class="content_mesas">
                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <ul class="listado-adicion" data-bind='template: { name: "listaMesasCajero", foreach: adn().mesasCerradas }'>
                       
                </ul>
        </div><!-- /navbar -->
            
        <div  data-role="footer" data-position="fixed">
                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mesas">Modo Adicionista</a></li>
                            <li><a href="#listado-mesas-cerradas" class="ui-btn-active ui-state-persist">Modo Cajero</a></li>
                        </ul>
                </div>
        </div>

</div>
<!-- Fin Pagina Cajero -->







<!--
                        MESA-ADD

-->
<div  data-role="page"  id="mesa-add" data-theme="e">
        <div  data-role="header"  data-position="inline">
            <h1>Abrir Mesa</h1>
            <a href="#"  data-rel="back">Cancelar</a>
        </div>
    
        <div data-role="content">
            <form name="form-mesa-add" action="#" id="form-mesa-add">
                <div data-role="">
                    <fieldset data-role="controlgroup" data-type="horizontal">
                        <?php
                        $first = true;
                            foreach ($mozos as $m) {
                                $k = $m['Mozo']['id'];
                                $n = $m['Mozo']['numero'];
                                $cheked = '';
                                if ($first) {
                                    $cheked = "checked='true'";
                                    $first = false;
                                }
                                echo "<input $cheked type='radio' name='mozo_id' id='radio-mozo-id-$k' value='$k'/>";
                                echo "<label for='radio-mozo-id-$k'>$n</label>";
                            }
                        ?>
                    </fieldset>

                    <fieldset data-role="fieldcontain">
                        <label for="numero">Escribir Número de Mesa:</label>
                        <input type="text" name="numero" data-risto="mesa"/>
                    </fieldset>
                    
                     <fieldset data-role="fieldcontain">
                        <label for="cant_comensales">Cantidad de Cubiertos:</label>
                        <input type="text" name="cant_comensales"/>
                    </fieldset>
                    
                    <fieldset>
                        <button type="submit"  data-theme="b">Abrir Mesa</button>
                    </fieldset>
                </div>
            </form>
        </div>
</div> 





<!--
                        OBSERVACIONES

-->
<div  data-role="page"  id="obss">
    <div  data-role="header"  data-position="inline">
        <h1>Observacion</h1>
        <a href="#"  data-rel="back"  onclick="$('#form-comanda-producto-observacion').submit();" data-theme="b">Guardar Observación</a>
    </div>
    <div data-role="content">
        <form name="comanda" id="form-comanda-producto-observacion">
            <textarea name="obs" id="obstext" autofocus="true"></textarea>
        </form>
        
        <div class="observaciones-list">
                <?php foreach($observaciones as $o) { ?>
                <a data-role="button" data-inline="true" href="#" onclick="$('#obstext').val( $('#obstext').val()+', <?php echo $o?>' )"><?php echo $o?></a>
                <?php } ?>
        </div>
    </div>
    
</div> 




<!--
                        MESA_VIEW

-->
<div data-role="page" id="mesa-view">
	<div  data-role="header" data-bind="css: {'ui-bar-f': adn().currentMesa().estaCerrada()}">
            <a href="#listado-mesas" data-transition="slide" data-direction="reverse">Volver</a>
            <h1>
                <span class="mesa-id" style="float: left;">
                    #<span data-bind="text: adn().currentMesa().id()"></span>
                    <span data-bind="visible: !adn().currentMesa().id()">
                        <?php echo $html->image('loader.gif'); ?>
                    </span>
                </span>
                
                <span data-bind="text: adn().currentMesa().numero"></span>
                <?php echo $html->image('mesa-abrio.png') ?> Mesa  - 
                Mozo <?php echo $html->image('mozomoniob.png') ?>
                <span data-bind="text: adn().currentMesa().mozo().numero"></span>
                 
                <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
            </h1>
        </div>

        <div  data-role="content" class="" data-scroll="true">
            <div class="mesa-actions">
                <ul data-role="listview">
                    
                    <li id="mesa-action-comanda" data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#comanda-add-menu" data-rel="dialog"  data-transition="none"><?= $html->image('/adition/css/img/chef_64.png')?>Comanda</a>
                    </li>
                    
                    <li id="mesa-action-cliente" data-bind="attr: {'estado': 'mesa-cliente_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="<?php echo $html->url('/clientes/jqm_clientes')?>" data-rel="dialog" data-transition="fade">
                                <?= $html->image('/adition/css/img/customers.png')?>
                            <span data-bind="visible: !adn().currentMesa().Cliente()">Agregar Cliente</span>
                            <span data-bind="visible: adn().currentMesa().Cliente()">Cliente: <span data-bind="text: adn().currentMesa().clienteNameData()"></span></span>
                        </a>
                    </li>
                    
                    <li id="mesa-action-cerrar" data-bind="attr: {'estado': 'mesa-cerrar_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-cerrar" data-direction="reverse" data-transition="slide"><?= $html->image('/adition/css/img/cerrarmesa.png')?>Cerrar Mesa</a>
                    </li>
                    
                    
                    <li id="mesa-action-cobrar" data-bind="attr: {'estado': 'mesa-cobrar_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#mesa-cobrar" data-rel="dialog"><?= $html->image('/adition/css/img/cobrar.png')?>Cobrar</a>
                    </li>
                    
                    <li id="mesa-action-reimprimir" data-bind="attr: {'estado': 'mesa-re-print_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-reimprimir"  data-rel="back"><?= $html->image('/adition/css/img/printer.png')?>Imprimir Ticket</a>
                    </li>

                    
                    <li id="mesa-action-cambiar-mozo">
                        <a href="#mesa-cambiar-mozo" data-rel="dialog"  data-transition="pop"><?= $html->image('/adition/css/img/cambiarmozo.png')?>Cambiar Mozo</a>
                    </li>
                    
                    <li id="mesa-action-cambiar-numero">
                        <a href="#mesa-cambiar-numero" data-rel="dialog"  data-transition="pop"><?= $html->image('/adition/css/img/cambiarmesa.png')?>Cambiar N°</a>
                    </li>
                    
                    <li id="mesa-action-reabrir" data-bind="attr: {'estado': 'mesa-reabrir_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-reabrir"><?= $html->image('/adition/css/img/reabrir.png')?>Re Abrir</a>
                    </li>
                    
                    <hr />
                    <li id="mesa-action-borrar" data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-borrar" data-rel="back"><?= $html->image('/adition/css/img/borrarmesa.png')?>Borrar Mesa</a>
                    </li>
                </ul>
            </div>

            <div class="mesa-view">
                <h3 class="titulo-comanda">Detalle de Consumición</h3>

                <!-- template -->
                <div id="comanda-detalle-collapsible" data-role="collapsible-set" 
                     data-bind="template: {name: 'listaComandas', foreach: adn().currentMesa().Comanda}"></div>
            </div>
            
        </div>
    
    <div data-role="footer" data-position="fixed">
        <h3>
            <span class="cant_comensales" data-bind="visible: adn().currentMesa().cant_comensales() > 0"><span data-bind="text: adn().currentMesa().cant_comensales()"></span> Cubiertos</span>
            <span class="mesa-total"><span data-bind="text: adn().currentMesa().textoTotalCalculado"></span></span>
            <span class="hora-abrio">Abrió a las <span data-bind="text: adn().currentMesa().timeCreated()"></span></span>
        </h3>
    </div>
</div>


<!--
                        COMANDA-ADD

-->
<div data-role="page" id="comanda-add-menu">
    <div  data-role="header"  data-position="inline">
<!--        <a data-rel="back" data-transition="reverse" href="#">Cancelar</a>-->

        <div style="margin-left: 40px; text-align: center; height: 40px; margin-top: 5px;">
            <h3 style="display: inline; text-align: center; margin-top: 8px;">Nueva Comanda para la mesa <span data-bind="text: adn().currentMesa().numero"></span></h3>
            
            <span style="float: right; margin-right: 10px;">
                
                <a href="#" title="Actualizar Menú" onclick="Risto.Adition.menu.update()"><?php echo $html->image('refresh.png', array('width'=> 35))?></a>
                
                <a href="#" title="Agregar Observación" onclick="$('#comanda-add-observacion').toggle('slow').focus();"><?php echo $html->image('pencil_48.png', array('width'=> 35))?></a>
                <a href="#" title="Haga click para desactivar la impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 0 )}, visible: adn().currentMesa().currentComanda().comanda.imprimir()"><?php echo $html->image('print48.png', array('width'=> 35))?></a>
                <a href="#" title="Haga click para activar impresión de comanda" data-bind="click: function(){adn().currentMesa().currentComanda().comanda.imprimir( 1 )}, visible: !adn().currentMesa().currentComanda().comanda.imprimir()" ><?php echo $html->image('dontprint48.png', array('width'=> 35))?></a>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <a href="#mesa-view" data-role="button" id="comanda-add-guardar"  data-inline="true" data-icon="check" data-theme="b">Guardar</a>        
                
            </span>
        </div>
    </div>

    <div data-role="content">   
        <div style="display: none" id="comanda-add-observacion" class="ui-corner-bottom ui-overlay-shadow ui-content">
            <h4>Agregar observación general para la comanda</h4>
            <textarea data-bind="value: adn().currentMesa().currentComanda().comanda.observacion, valueUpdate: 'keyup'" autofocus="true" id="obstext" name="obs" class="ui-input-text ui-body-null ui-corner-all ui-shadow-inset ui-body-a"></textarea>
            <a href="#" onclick="$('#comanda-add-observacion').toggle('slow')" data-role="button">Aceptar</a>
        </div>
        <!--        PRODUCTOS SELECCIONADOS    -->
        <div  style="width: 28%; margin-right: 2%; display: inline; float: left;">
            
           <ul id="ul-productos-seleccionados" class="ui-listview" data-role="listview"
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: adn().productosSeleccionados}"
                ></ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">
            <div id="path" data-bind="template: {name: 'boton', foreach: menu().path}"></div> 
            
            <!--           SELECCION DE CATEGORIAS                           -->
           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: menu().currentSubCategorias} ">
           </div>
           
            <!--           SELECCION DE PRODUCTOS                            -->
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: menu().currentProductos} ">
           </div>
        </div>
    </div>
        
</div>  





<!--
                        SABORES-ADD

-->
<div data-role="page" id="page-sabores" data-theme="b">
    <div data-role="header">
        <h1>Seleccionar sabores</h1>
               
	<a href="#" data-icon="check" data-theme="b" data-rel="back" data-bind="click: function(){adn().currentMesa().currentComanda().saveSabores()}">Guardar</a>        
    </div>

    <div data-role="content">                  
           <div id="ul-sabores" 
                data-bind="template: {name: 'listaSabores', foreach: adn().currentSabores} ">
           </div>
    </div>
            
</div>  






<!--
                    MESA CAMBIAR MOZO

-->
<div data-role="page" id="mesa-cambiar-mozo" data-theme="e">
    <div data-role="header">
        <h1>Seleccionar nuevo Mozo para la mesa <span data-bind="text: adn().currentMesa().numero"></span></h1>
    </div>

    <div data-role="content">           
        
        <div>
            El mozo actual es el <span data-bind="text: adn().currentMesa().mozo().numero"></span>
        </div>
        
        <form name="cambiar-mozo" id="form-cambiar-mozo" action="#" data-ajax="false"  data-direction="reverse">
            <input type="hidden" name="mesa_id" data-bind="value: adn().currentMesa().id"/>
            <fieldset data-role="controlgroup" data-type="horizontal">
                            <legend style="display: block; clear: both;">Seleccionar Mozo:</legend>
                            <?php
                                foreach ($mozos as $m) {
                                    $k = $m['Mozo']['id'];
                                    $n = $m['Mozo']['numero'];
                                    echo "<input  type='radio' name='mozo_id' id='radio-mozo-id-$k' value='$k'/>";
                                    echo "<label for='radio-mozo-id-$k'>$n</label>";
                                }
                            ?>
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Cambiar de Mozo</button></div>
	    </fieldset>
        </form>
    </div>
            
</div>  





<!--
                    MESA CAMBIAR NUMERO

-->
<div data-role="page" id="mesa-cambiar-numero" data-theme="e">
    <div data-role="header">
        <h1>Cambiar número de la Mesa <span data-bind="text: adn().currentMesa().numero"></span></h1>
    </div>

    <div data-role="content">    
        <p>
        El número actual es <span data-bind="text: adn().currentMesa().numero"></span>
        </p>
        <form name="cambiar-mozo" id="form-cambiar-numero" action="#" data-ajax="false"  data-direction="reverse">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <legend for="numeroacambiar">Ingresar nuevo número</legend>
                <input type="text" name="numero" />
            </fieldset>
            
            <fieldset class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back" data-theme="e">Cancelar</a></div>
                <div class="ui-block-b"><button type="submit" data-theme="b">Guardar nuevo Número de Mesa</button></div>
	    </fieldset>
            
        </form>
    </div>
            
</div>  




<!--
                    MESA COBRAR

-->
<div data-role="page" id="mesa-cobrar" data-theme="e">
    <div data-role="header">
        <h1>Mesa <span data-bind="text: adn().currentMesa().numero"></span> | <span data-bind="text: adn().vueltoText"></span></h1>
        <a href="#mesa-view" data-transition="slide" data-direction="reverse" data-theme="b">Ir a la Mesa</a>
    </div>

    <div data-role="content">                  
        <h2>Cobrar la mesa</h2>
        
        <ul class="tipo_de_pagos">
        <?php 
        foreach ( $tipo_de_pagos as $tp ){
            $pago = $tp['TipoDePago'];
            $pagoJson =  $javascript->object($pago);
            ?>
            <li>
                <a href="#" onclick='new Risto.Adition.pago(<?php echo $pagoJson?>)'>
            <?php
            echo $html->image($tp['TipoDePago']['image_url']);
            echo '<br />';
            echo $pago['name'];
            ?>
                </a>
                </li>
                <?php
        }
        ?>
        </ul>
        
        <h4>Pagos Seleccionados</h4>
        <ul class="pagos_creados"
            data-bind='template: { name: "li-pagos-creados", foreach: adn().pagos }'>
        </ul>
        
            <div class="ui-grid-a">
                <div class="ui-block-a"><a href="#" data-role="button" data-rel="back">Cancelar</a></div>
                <div class="ui-block-b"><a href="#" data-role="button" data-rel="back" data-theme="b" id="mesa-pagos-procesar">Cerrar Mesa</a></div>
	    </div>
    </div>
    
            
</div>  

