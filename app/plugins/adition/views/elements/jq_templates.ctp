<!-- Template: listado de comandas con sus productos-->
<script id="listaComandas" type="text/x-jquery-tmpl">
   <div data-role="collapsible">
       <h3>
           <span class="id-comanda">#<span data-bind="text: id()"></span></span>  <span class="hora-comanda"  data-bind="text: timeCreated()"></span>&nbsp;&nbsp;&nbsp;
           <span class="comanda-listado-productos-string" data-bind="text: productsStringListing()"></span>
       </h3>

        <ul class="comanda-items" data-role="listview"
           data-bind="template: {name: 'li-productos-detallecomanda', foreach: DetalleComanda}"
           style="margin: 0px;">

        </ul>                                                                           
   </div>
</script>




<!--  TEmplate: Productos seleccionados en el menu. comandas add -->
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
         </span>

         <span data-bind="text: nameConSabores()"></span>

         <span data-bind="text: realCant()" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
     </li>
 </script>
 
 
 
 <!-- Template: Comanda Add menu path-->
 <script id="boton" type="text/x-jquery-tmpl">
        <a data-bind="attr: {'data-icon': esUltimoDelPath()?'':'back', 'data-theme': esUltimoDelPath()?'a':''}, click: seleccionar" data-bind="click: seleccionar" class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
             <span class="ui-btn-inner ui-btn-corner-all">
                 <span class="ui-btn-text" data-bind="text: name" ></span>
                 <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
             </span>
         </a>
</script>




<!-- Template: Caomanda add: listado de categorias                                  -->
<script id="listaCategoriasTree" type="text/x-jquery-tmpl">
   <a  href="#" data-bind="click: seleccionar" data-theme="b" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-b">
       <span class="ui-btn-inner ui-btn-corner-all btn-categoria">
               <image class="menu-img" data-bind="visible: image_url, attr: {src: urlDomain+'img/menu/'+image_url}"/>
               <br />
               <span class="menu-letra-con-imagen" data-bind="text: name"></span>                         
       </span>
   </a>
</script>


<!-- Template: Caomanda add: listado de productos -->
<script id="categorias-productos" type="text/x-jquery-tmpl">
     <a data-bind="click: seleccionar, attr: { href: tieneSabores() ? '#page-sabores' : '#'}" 
        data-rel="dialog"  data-transition="fade" 
        class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-e">
         <span class="ui-btn-inner ui-btn-corner-all">
             <span class="ui-btn-text" data-bind="text: name" ></span>
             <span class="ui-icon ui-icon-right ui-icon-shadow" data-bind="css: {'ui-icon-forward': tieneSabores()}"></span>
         </span>
     </a>
 </script>
 
 
 
 <!-- Template: Comanda Add, Listado de sabores de categorias       -->
<script id="listaSabores" type="text/x-jquery-tmpl">
   <a href="#"  data-bind="click: seleccionar" data-theme="c" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
       <span class="ui-btn-inner ui-btn-corner-all">
           <span class="ui-btn-text">
               <span data-bind="text: name"></span>                         
           </span>
       </span>
   </a>
</script>


<!-- listado de pagos seleccionados -->
<script id="li-pagos-creados" type="text/x-jquery-tmpl">
     <li>
         <img src="" data-bind="attr: {src: image(), alt: TipoDePago().name, title: TipoDePago().name}"/>
         <label>Ingresar Valor $: </label>
         <input name="valor" data-bind="value: valor, valueUpdate: 'keyup'" placeholder="Ej: 100.4"/>
     </li>
</script>





<!-- Template: Listado de productos del detalle Comanda -->
<script id="li-productos-detallecomanda" type="text/x-jquery-tmpl">
 <li>
     <span data-type="horizontal" data-role="controlgroup">
        <a id="mesa-action-detalle-comanda-sacar-item" data-bind="click: deseleccionarYEnviar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c">
            -</a>
        <a data-bind="css: { es_entrada: esEntrada()}" data-role="button" data-iconpos="notext" data-icon="entrada" href="#" title="Entrada" data-theme="c">
            Entrada
        </a>
     </span>

     <span data-bind="text: realCant()" style="padding-left: 20px;"></span>
     <span data-bind="text: nameConSabores(), css: {tachada: realCant()==0}" style="padding-left: 20px;"></span>
     <span class="producto-precio">p/u: {{= '$'}}<span data-bind="text: Producto().precio"></span></span>
 </li>
</script>




<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-jquery-tmpl">
    <li data-bind="attr: {mozo: mozo().id(), 'class': getEstadoIcon()}">
        <a  data-bind="click: seleccionar, attr: {accesskey: numero, id: 'mesa-id-'+id()}" 
            data-theme="c"
            data-role="button" 
            href="#mesa-view" 
            class="ui-btn ui-btn-up-c">
            <span class="mesa-span ui-btn-inner">
                <span class="ui-btn-text">
                    <span class="mesa-numero" data-bind="text: numero"></span>
                    
                    <br />
                    <span class="mesa-time" data-bind="text: textoHora()"></span>
                </span>
            </span>
            <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
        </a>
    </li>
</script>


<!-- Template: 
listado de mesas que será refrescado continuamente mediante 
es igual al de las mesas de la adicion salvo que al hacer click tienen otro comportamiento
-->
<script id="listaMesasCajero" type="text/x-jquery-tmpl">

    <li data-bind="attr: {mozo: mozo().id(), 'class': getEstadoIcon()}">
        <a  data-bind="click: seleccionar" 
            data-theme="c"
            data-role="button" 
            href="#mesa-cobrar"
            data-rel="dialog"
            data-transition="none" 
            class="ui-btn ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-c">
            <span class="mesa-span ui-btn-inner ui-btn-corner-all">
                <span class="ui-btn-text">
                    <span class="mesa-numero" data-bind="text: numero"></span>
                    <span class="mesa-mozo" data-bind="text: mozo().numero"></span>
                    <br />
                    <span class="mesa-time" data-bind="text: textoHora()"></span>
                </span>
                <span class="mesa-icon ui-icon ui-icon-shadow" data-bind="css: {'ui-icon-mesa-abierta': getEstadoIcon()!='mesa-cerrada', 'ui-icon-mesa-cerrada': getEstadoIcon()=='mesa-cerrada', 'ui-icon-mesa-cobrada': getEstadoIcon()=='mesa-cobrada'}"></span>
            </span>
        </a>
    </li>
</script>
