<script id="li-productos-detallecomanda" type="text/x-jquery-tmpl">
     <li  class="ui-li ui-li-static ui-body-c">
         <span data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">-</span><span class="ui-icon ui-icon-minus ui-icon-shadow"></span></span></a>
            <a data-bind="style: { background: esEntrada() ? '#437FBE' : ''}" data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">Entrada</span><span class="ui-icon ui-icon-entrada ui-icon-shadow"></span></span></a>
         </span>

         <span data-bind="text: realCant()" style="right: auto" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
         <span data-bind="text: nameConSabores()" style="padding-left: 40px;"></span>
     </li>
</script>
                  
                                         
<!--
                        LISTADO MESAS

-->
<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" id="listado-mesas">

	<div  data-role="header">
            <h1><span style="color: #fcf0b5" data-bind="text: adn().mesas().length">0</span> Mesas Abiertas</h1>

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
            
            
            
                    <!-- Botones de muestra  
                    <a href="#" data-role="button" data-icon="mesa-abierta" data-theme="c" data-iconpos="notext"></a>
                    <a href="#" data-role="button" data-icon="mesa-porcerrar" data-theme="c" data-iconpos="notext" data-iconpos="right"></a>
                    <a href="#" data-role="button" data-icon="mesa-cerrada" data-theme="c"  data-iconpos="notext" >Mesa loca</a>
                    -->
                
                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <a href="#mesa-add" data-rel="dialog"  data-transition="pop" class="grid_1 abrir-mesa" href="#" data-role="button" data-theme="a">Abrir<br>Mesa</a>  
                <ul id="mesas_container" class="listado-adicion" data-bind='template: { name: "listaMesas", foreach: adn().mesas }'>
                        <!-- Template: 
                            listado de mesas que será refrescado continuamente mediante 
                            el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
                        <script id="listaMesas" type="text/x-jquery-tmpl">

                            <li class="grid_2 li-btn" data-bind="attr: {mozo: mozo().id()}">
                                <a  data-bind="click: seleccionar, attr: {accesskey: numero}, css: {'ui-btn-up-f': estaCerrada(), 'ui-btn-up-c': !estaCerrada()}" 
                                    data-theme="c"
                                    data-role="button" 
                                    href="#mesa-view" 
                                    class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow">
                                    <span class="mesa-span ui-btn-inner ui-btn-corner-all">
                                        <span class="ui-btn-text">
                                            <span class="mesa-numero" data-bind="text: numero"></span>
                                            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
                                           
                                        </span>
                                        <span class="mesa-icon ui-icon ui-icon-shadow" data-bind="css: {'ui-icon-mesa-abierta': getEstadoIcon()!='mesa-cerrada', 'ui-icon-mesa-cerrada': getEstadoIcon()=='mesa-cerrada'}"></span>
                                        
                                    </span>

                                    
                                    
                                </a>
                            </li>
                        </script>
                </ul>
        </div><!-- /navbar -->
            
        <div  data-role="footer" data-position="fixed">
                <div data-role="navbar">
                        <ul>
                            <li><a onclick="Risto.Adition.adicionar.mozosOrder('numero')">Ordenar Por Numero</a></li>
                            <li><a onclick="Risto.Adition.adicionar.mozosOrder('mozo_id')">Ordenar Por Mozo</a></li>
                            <li><a onclick="Risto.Adition.adicionar.mozosOrder('created')">Ordenar Por Cierre</a></li>
                        </ul>
                </div>
        </div>

</div>
<!-- Fin Pagina 1 -->



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

                    <fieldset data-role="fieldcontain">
                        <label for="numero">Escribir Número de Mesa:</label>
                        <input type="text" name="numero" data-risto="mesa"/>
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
    </div>
</div> 




<!--
                        MESA_VIEW

-->
<div data-role="page" id="mesa-view">
	<div  data-role="header" data-bind="css: {'ui-bar-f': adn().currentMesa().estaCerrada()}">
            <a href="#listado-mesas" data-transition="slide" data-direction="reverse">Volver</a>
            <h1>
                Mesa <span data-bind="text: adn().currentMesa().numero"></span> | Mozo <span data-bind="text: adn().currentMesa().mozo().numero"></span>
                <span class="hora-abrio">Estado: <span data-bind="text: adn().currentMesa().getEstadoName()"></span></span>
            </h1>
        </div>

        <div  data-role="content" class="" data-scroll="true">
            <div class="mesa-actions" style="width: 29%; float: left;">
                <ul data-role="listview" style="width: 100%">
                    
                    <li data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#comanda-add-menu" data-rel="dialog"  data-transition="pop"><?= $html->image('/adition/css/img/chef_64.png')?>Comanda</a>
                    </li>
                    
                    <li data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="<?php echo $html->url('/clientes/jqm_clientes')?>" data-rel="dialog" data-transition="fade">
                                <?= $html->image('/adition/css/img/addcliente.png')?>
                            <span data-bind="visible: !adn().currentMesa().Cliente()">Agregar Cliente</span>
                            <span data-bind="visible: adn().currentMesa().Cliente()">Cliente: <span data-bind="text: adn().currentMesa().clienteNameData()"></span></span>
                        </a>
                    </li>
                    
                    <li data-bind="attr: {'estado': 'comanda-add-menu_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-cerrar" data-direction="reverse" data-transition="slide"><?= $html->image('/adition/css/img/cerrarmesa.png')?>Cerrar Mesa</a>
                    </li>
                    
                    <li>
                        <a href="#mesa-cambiar-mozo" data-rel="dialog"  data-transition="pop"><?= $html->image('/adition/css/img/cambiarmozo.png')?>Cambiar Mozo</a>
                    </li>
                    <li>
                        <a href="#mesa-cambiar-numero" data-rel="dialog"  data-transition="pop"><?= $html->image('/adition/css/img/cambiarmesa.png')?>Cambiar N°</a>
                    </li>
                        <li data-bind="attr: {'estado': 'mesa-re-print_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#mesa-re-print" ><?= $html->image('/adition/css/img/reimprimir.png')?>Reimprimir Ticket</a>
                    </li>
                    <li data-bind="attr: {'estado': 'mesa-borrar_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-borrar" data-rel="back"><?= $html->image('/adition/css/img/borrarmesa.png')?>Borrar Mesa</a>
                    </li>
                    <li data-bind="attr: {'estado': 'mesa-cobrar_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#mesa-cobrar"><?= $html->image('/adition/css/img/cobrar.png')?>Cobrar</a>
                    </li>
                    
                    <li data-bind="attr: {'estado': 'mesa-reabrir_'+adn().currentMesa().getEstadoIcon()}">
                        <a href="#listado-mesas" id="mesa-reabrir"><?= $html->image('/adition/css/img/reabrir.png')?>Re Abrir</a>
                    </li>
                </ul>
            </div>

            <div class="mesas view" style="width: 70%; float:right; margin-top: -7px;" >
                <h3 class="titulo-comanda">Detalle de Consumición</h3>

                <div id="comanda-detalle-collapsible" data-role="collapsible-set" data-bind="template: {name: 'listaComandas', foreach: adn().currentMesa().Comanda}">
                        <!-- Template: listado de comandas con sus productos-->
                        <script id="listaComandas" type="text/x-jquery-tmpl">
                           <div data-role="collapsible">
                               <h3><span class="id-comanda">#<span data-bind="text: id"></span></span>  <span class="hora-comanda"  data-bind="text: timeCreated()"></span>&nbsp;&nbsp;&nbsp;
                                   <span class="comanda-listado-productos-string" data-bind="text: productsStringListing()"></span>
                               </h3>

                                <ul class="ui-listview comanda-items" data-role="listview"
                                   data-bind="template: {name: 'li-productos-detallecomanda', foreach: DetalleComanda}"
                                   style="margin: 0px;">
                                </ul>                                                                           
                           </div>
                        </script>
                </div>

            </div>
            
        </div>
    
    <div data-role="footer" data-position="fixed">
        <h3>
            <span class="mesa-total"><span data-bind="text: adn().currentMesa().totalCalculado"></span></span>
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
	<h1>Nueva Comanda</h1>
	<a href="#mesa-view" data-icon="check" data-theme="b" data-bind="click: function(){adn().currentMesa().currentComanda().save()}">Guardar</a>        
    </div>

    <div data-role="content">
        
        
        <!--        PRODUCTOS SELECCIONADOS    -->
        <div  style="width: 28%; margin-right: 2%; display: inline; float: left;">
           <ul id="ul-productos-seleccionados" class="ui-listview" data-role="listview"
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: adn().productosSeleccionados}"
                >
                 <script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
                     <li data-bind="visible: cant()"  class="ui-li ui-li-static ui-body-c">
                         <span data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
                            <a data-bind="click: seleccionar" data-role="button" data-icon="plus" data-iconpos="notext" href="#" title="+" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-left ui-btn-up-c"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text" >+</span><span class="ui-icon ui-icon-plus ui-icon-shadow"></span></span></a>
                            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">-</span><span class="ui-icon ui-icon-minus ui-icon-shadow"></span></span></a>
                            <a data-bind="click: addObservacion, style: { background: observacion() ? '#437FBE' : ''}" 
                               data-rel="dialog"  
                               data-role="button"
                               data-iconpos="notext" 
                               data-icon="grid" 
                               href="#obss" 
                               title="Observación" 
                               data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c">
                                <span class="ui-btn-inner">
                                    <span class="ui-btn-text">Observación
                                    </span>
                                    <span class="ui-icon ui-icon-grid ui-icon-shadow"></span>
                                </span>
                            </a>
                            <a data-bind="click: toggleEsEntrada, style: { background: esEntrada() ? '#437FBE' : ''}" data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">Entrada</span><span class="ui-icon ui-icon-entrada ui-icon-shadow"></span></span></a>
                         </span>

                         <span data-bind="text: nameConSabores()"></span>

                         <span data-bind="text: realCant()" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
                     </li>
                 </script>
           </ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">
             <!--           PATH DE CATEGORIAS                           -->
            <div id="path" data-bind="template: {name: 'boton', foreach: menu().path}">
                <script id="boton" type="text/x-jquery-tmpl">
                        <a data-bind="attr: {'data-icon': esUltimoDelPath()?'':'back', 'data-theme': esUltimoDelPath()?'a':''}, click: seleccionar" data-bind="click: seleccionar" class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
                             <span class="ui-btn-inner ui-btn-corner-all">
                                 <span class="ui-btn-text" data-bind="text: name" ></span>
                                 <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
                             </span>
                         </a>
                </script>
           </div> 
            
            <!--           SELECCION DE CATEGORIAS                           -->
           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: menu().currentSubCategorias} ">
                <!-- Template de categorias                                  -->
               <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                   <a  href="#" data-bind="click: seleccionar" data-theme="b" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-b">
                       <span class="ui-btn-inner ui-btn-corner-all">
                           <span class="ui-btn-text">
                               <image class="menu-img" src="" data-bind="visible: image_url, attr: {src: urlDomain+'img/'+image_url}"/>
                               <span data-bind="text: name, css: {'menu-letra-con-imagen': image_url}"></span>                         
                           </span>
                       </span>
                   </a>
                </script>
           </div>
           
            <!--           SELECCION DE PRODUCTOS                            -->
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: menu().currentProductos} ">
                 <script id="categorias-productos" type="text/x-jquery-tmpl">
                     <a data-bind="click: seleccionar, attr: { href: tieneSabores() ? '#page-sabores' : '#'}" data-rel="dialog"  data-transition="fade" class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-e">
                         <span class="ui-btn-inner ui-btn-corner-all">
                             <span class="ui-btn-text" data-bind="text: name" ></span>
                             <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
                         </span>
                     </a>
                 </script>
           </div>
        </div>
    </div>
        
</div>  





<!--
                        SABORES-ADD

-->
<div data-role="page" id="page-sabores" data-theme="b">
    <div data-role="header">
        <h1>Seleccionar sabores<span></span></h1>
               
	<a href="#" data-icon="check" data-theme="b" data-rel="back" data-bind="click: function(){adn().currentMesa().currentComanda().saveSabores()}">Guardar</a>        
    </div>

    <div data-role="content">                  
           <div id="ul-sabores" 
                data-bind="template: {name: 'listaSabores', foreach: adn().currentSabores} ">
                <!-- Template de categorias       -->
               <script id="listaSabores" type="text/x-jquery-tmpl">
                   <a href="#"  data-bind="click: seleccionar" data-theme="c" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
                       <span class="ui-btn-inner ui-btn-corner-all">
                           <span class="ui-btn-text">
                               <span data-bind="text: name"></span>                         
                           </span>
                       </span>
                   </a>
                </script>
           </div>
    </div>
            
</div>  






<!--
                    MESA CAMBIAR MOZO

-->
<div data-role="page" id="mesa-cambiar-mozo" data-theme="e">
    <div data-role="header">
        <h1>Seleccionar nuevo Mozo</h1>
    </div>

    <div data-role="content">                  
        
        <form name="cambiar-mozo" action="#">
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
        </form>
        
        
        <a href="#" data-rel="back" data-role="button" data-inline="true" data-theme="e">Cancelar</a>
        <a href="#" data-rel="back" data-role="button" data-inline="true" data-theme="b">Guardar nuevo mozo</a>
    </div>
            
</div>  





<!--
                    MESA CAMBIAR NUMERO

-->
<div data-role="page" id="mesa-cambiar-numero" data-theme="e">
    <div data-role="header">
        <h1>Nuevo Número de Mesa</h1>
    </div>

    <div data-role="content">                  
        
        <form name="cambiar-mozo" action="#">
            <fieldset data-role="controlgroup" data-type="horizontal">
                <legend for="numeroacambiar">Ingresar nuevo número</legend>
                <input type="number"></input>
            </fieldset>
        </form>
        
        
        <a href="#" data-rel="back" data-role="button" data-inline="true" data-theme="e">Cancelar</a>
        <a href="#" data-rel="back" data-role="button" data-inline="true" data-theme="b">Guardar nuevo Número de Mesa</a>
    </div>
            
</div>  

