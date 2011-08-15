    

<!-- Template: listado de mesas que será refrescado continuamente mediante el ajax que verifica el estado de las mesas (si fue abierta o cerrada alguna. -->
<script id="listaMesas" type="text/x-jquery-tmpl">
    <li class="grid_1">
        <a href="#mesa-view" data-role="none" class="mesa" data-bind="click: seleccionar" >
            (<span class="mesa-mozo" data-bind="text: mozo().numero" style="color: red"></span>)
            <span class="mesa-numero" data-bind="text: numero"></span>
        </a>
    </li>
</script>


<script id="listaMozos" type="text/x-jquery-tmpl">
    <li data-mesa-numero="${numero}" data-mozo-id="${id}" class="grid_1">
        <a href="mozos/view/${id}" data-role="none" class="mesa" >
            (<span class="mozo-numero" data-bind="text: numero()" style="color: red"></span>)
            <span class="mozo-cant-mesas" data-bind="text: mesas().length"></span> mesas
        </a>
    </li>
</script>


<script id="names" type="text/x-jquery-tmpl">
    <li data-bind="text: name"></li>
</script>
                
                

<!-- Pagina 1, Home Page por default segun JQM: Listado de Mesas -->
<div data-role="page" data-add-back-btn="true" id="listado-mesas">

	<div  data-role="header" data-position="inline">

                <h1><strong data-bind="text: mesas().length"></strong> Mesas Abiertas</h1>

                <a rel="external" href='#listado-mesas' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>
                
                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mozos">Mozos</a></li>
                            <li><a href="#listado-mesas" class="ui-btn-active">Mesas</a></li>
                        </ul>
                </div>
        </div>

        <div  data-role="content" class="">

            <div> </div>
            
            <span>
                <a href="#mesa-add" class="mesa" data-rel="dialog">
                        Abrir Mesa
                </a>
            </span>
            <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
            <ul id="mesas_container" class="container_12 listado-mesas"
                data-bind='template: { name: "listaMesas", foreach: mesas }'>
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
            Ristorantino Mágico</div>

</div>
<!-- Fin Pagina 1 -->


<!-- Pagina 2: Listado de Mozos -->
<div data-role="page" data-add-back-btn="true" id="listado-mozos">

	<div  data-role="header" data-position="inline">
                <h1>Mozos</h1>
                
                <a rel="external" href='<?= $html->url('/adition/adicionar') ?>' data-icon="home" data-iconpos="notext" data-direction="reverse" class="">Home</a>

                <div data-role="navbar">
                        <ul>
                            <li><a href="#listado-mozos">Mozos</a></li>
                            <li><a href="#listado-mesas">Mesas</a></li>
                        </ul>
                </div>
        </div>

        <div data-role="content" class="container_12">

                <!-- aca va el listado de mesas que se carga dinamicamente en un script de abajo -->
                <ul id="mesas_container" class="container_12 listado-mesas"
                    data-bind='template: { name: "listaMozos", foreach: mozos }'>
                </ul>
        </div>

        <div  data-role="footer" data-position="fixed">
            Ristorantino Mágico</div>
</div>
<!-- Fin Pagina 2: Listado de Mozos -->


<div  data-role="page"  id="mesa-add">
    <div  data-role="header"  data-position="inline">
        <h1>Abrir Mesa</h1>
        <a href="#"  data-rel="back"  onclick="$('#form-comanda-producto-observacion').submit();" data-theme="b">Guardar Observación</a>
    </div>
    <div data-role="content">
        <form name="comanda" id="form-comanda-producto-observacion">
            <div data-role="fieldcontain">
                <fieldset data-role="controlgroup"  data-type="horizontal">
                    <legend>Seleccionar Mozo:</legend>
                    <?php
                        foreach ($mozos as $m) {
                            $k = $m['Mozo']['id'];
                            $n = $m['Mozo']['numero'];
                            echo "<input type='radio' name='mozo_id' id='radio-choice-$k' value='choice-$k' checked='checked' />";
                            echo "<label for='radio-choice-$k'>$n</label>";
                        }
                    ?>
                </fieldset>
                
                <fieldset data-role="controlgroup"  data-type="horizontal">
                    <legend>Número de Mesa:</legend>
                    <input type="text" name="mesa_numero" autofocus></input>
                    <label for="mesa_numero">Mesa</label>
                </fieldset>
            </div>
        </form>
    </div>
</div> 


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


<div data-role="page" id="mesa-view">
	<div  data-role="header" data-position="inline">
            <a data-rel="back" data-transition="reverse" href="#">Volver</a>
            
            <h1>Mesa N°<span data-bind="text: currentMesa().numero"></span>, Mozo <span data-bind="text: currentMesa().mozo().numero"></span>
                <span class="mesa-total" style="color: red;">$<span data-bind="text: currentMesa().total"></span></span>
            </h1>
<!--            <div data-role="navbar">
                    <ul>
                        <li><a href="#mesa-view" class="ui-btn-active">Vista Común</a></li>
                        <li><a href="#mesa-view-ticket">Vista Ticket</a></li>
                    </ul>
            </div>-->
        </div>

        <div  data-role="content" class="">
            
            <div class="" style="width: 28%; float: left;">
                <ul data-role="listview" style="width: 100%">
                    <li><a href="#comanda-add-menu" data-rel="dialog"><?= $html->image('/adition/css/img/chef_64.png')?>Comanda</a></li>
                    <li><a href="#sacar-item" >Sacar Item</a></li>
                    <li><a href="#Agregar Cliente" >Agregar Cliente</a></li>
                    <li><a href="#Agragar Descuento" >Agregar Descuento</a></li>
                    <li><a href="#Cerrar-mesa" >Cerrar Mesa</a></li>
                    <li><a href="#cambiar-mozo" >Cambiar Mozo</a></li>
                    <li><a href="#Cambiar N° Mesa" >Cambiar N°</a></li>
                    <li><a href="#re-print" >Re imprimir Ticket</a></li>
                    <li><a href="#Borrar-mesa" >Borrar Mesa</a></li>
                    <li><a href="#testiesto" >De la pagina de atras</a></li>
                </ul>
            </div>

            <div class="mesas view " style="width: 70%; float:right;" >
                <h1>Detalle de Consumición</h1>
                <div class="">

                    <ul data-bind="template: {name: 'listaComandas', foreach: currentMesa().Comanda}">
                        <!-- Template: listado de comandas con sus productos-->
                        <script id="listaComandas" type="text/x-jquery-tmpl">
                            <li>   
                               <span>Comanda ${id}</span> <span>${created}</span>
                               <ul>
                               {{each DetalleComanda}}
                                   <li>
                                       <b>${$value.cant() - $value.cant_eliminada()}</b>- ${$value.Producto().name}
                                   </li>
                               {{/each}}
                               </ul>
                            </li>
                        </script>
                    </ul>
              
                </div>

            </div>
            
        </div>
    
    <div data-role="footer">Pie de página</div>
</div>



        
<div data-role="page" id="comanda-add-menu">
    <div  data-role="header"  data-position="inline">
<!--        <a data-rel="back" data-transition="reverse" href="#">Cancelar</a>-->
	<h1>Nueva Comanda</h1>
	<a href="#mesa-view" data-icon="check" data-theme="b" data-bind="click: function(){currentMesa().currentComanda().save()}">Guardar</a>        
    </div>

    <div data-role="content">
        
         <script type="text/javascript">
             Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
        </script>
        
            
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
        
        
            
        <div  style="width: 28%; margin-right: 2%; display: inline; float: left;">
           <ul id="ul-productos-seleccionados" class=" ui-listview " data-role="listview"
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: currentMesa().currentComanda().comanda.DetalleComanda}"
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
                            <a data-bind="click: esEntrada() ? unsetEsEntrada : setEsEntrada, style: { background: esEntrada() ? '#437FBE' : ''}" data-role="button" data-iconpos="notext" data-icon="star" href="#" title="Entrada" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">Entrada</span><span class="ui-icon ui-icon-star ui-icon-shadow"></span></span></a>
                         </span>

                         <span data-bind="text: Producto().name"></span>

                         <span data-bind="text: cant" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
                     </li>
                 </script>
           </ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">

           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: menu().currentSubCategorias} ">
                <!-- Template de categorias       -->
               <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                   <a  href="#" data-bind="click: seleccionar" data-theme="b" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-b">
                       <span class="ui-btn-inner ui-btn-corner-all">
                           <span class="ui-btn-text">
                               <?php echo $html->image('ico_mozo.png', array('height'=>'40px'));?>
                               <span data-bind="text: name">Bebidas con Alcohol</span>                         
                           </span>
                       </span>
                   </a>
                </script>
           </div>
           
           
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: menu().currentProductos} ">
                 <script id="categorias-productos" type="text/x-jquery-tmpl">
                     <a href="#" data-bind="click: seleccionar" class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-e">
                         <span class="ui-btn-inner ui-btn-corner-all">
                             <span class="ui-btn-text" data-bind="text: name" ></span>
                             <span class="ui-icon ui-icon-right ui-icon-shadow"></span>
                         </span>
                     </a>
                 </script>
           </div>
        </div>
    </div>
        
    <div data-role="footer"><h2>Menu footer</h2></div>
    
</div>  



        
<div data-role="page" id="page-sabores">
    <div  data-role="header"  data-position="inline">
        <h1>Seleccionar sabores para <span></span></h1>
	<a href="#mesa-view" data-icon="check" data-theme="b" data-bind="click: function(){currentMesa().currentComanda().save()}">Guardar</a>        
    </div>

    <div data-role="content">                  
           
        <div style="width: 70%; display: inline; float: right;">

           <div id="ul-sabores" 
                data-bind="template: {name: 'listaSabores', foreach: currentMesa().currentComanda().currentSabores()} ">
                <!-- Template de categorias       -->
               <script id="listaSabores" type="text/x-jquery-tmpl">
                   <a  data-bind="click: seleccionar, attr: {href: hrefSegunSabor}" data-theme="c" data-inline="true" data-role="button" class="ui-btn ui-btn-inline ui-btn-corner-all ui-shadow ui-btn-up-c">
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
        
    <div data-role="footer"><h2>Menu footer</h2></div>
    
</div>  

