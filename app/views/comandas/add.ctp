        
<div data-role="page" id="comanda-add-menu">
    <div  data-role="header"  data-position="inline">
        <h1>Comanda</h1>
        <a href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
    </div>

    <div data-role="content">
        
         <script type="text/javascript">
              (function($){
                    <?php if ( !empty($mesa['Mesa']['id']) ) { ?>
                    var mesa = Risto.Adition.adicionar.setCurrentMesa( <? echo $mesa['Mesa']['id']?> );
//                    mesa.comandas( <?= $javascript->object($items);?> );
                    <?php }?>

                    Risto.Adition.koAdicionModel.refreshBinding();
                })(jQuery);
        </script>
            
       <div id="path" data-bind="template: {name: 'boton', foreach: path, afterRender: refreshPathPage}">
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
               data-bind="template: {name: 'categorias-productos-seleccionados', foreach: productosSeleccionados, afterRender: refreshProductosSeleccionadosPage}"
                >
                 <script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
                     <li data-bind="visible: cant()"  class="ui-li ui-li-static ui-body-c">
                         <span data-type="horizontal" data-role="controlgroup" class="ui-corner-all ui-controlgroup ui-controlgroup-horizontal">
                            <a data-bind="click: seleccionar" data-role="button" data-icon="plus" data-iconpos="notext" href="#" title="+" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-left ui-btn-up-c"><span class="ui-btn-inner ui-corner-left"><span class="ui-btn-text" >+</span><span class="ui-icon ui-icon-plus ui-icon-shadow"></span></span></a>
                            <a data-bind="click: deseleccionar" data-role="button" data-icon="minus" data-iconpos="notext" href="#" title="-" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">-</span><span class="ui-icon ui-icon-minus ui-icon-shadow"></span></span></a>
                            <a data-bind="click: addObservacion, style: { background: observacion() ? '#437FBE' : ''}" data-rel="dialog"  data-role="button" data-iconpos="notext" data-icon="grid" data-rel="dialog" href="#" title="Observación" data-theme="c" class="ui-btn ui-btn-icon-notext ui-btn-up-c"><span class="ui-btn-inner"><span class="ui-btn-text">Observación</span><span class="ui-icon ui-icon-grid ui-icon-shadow"></span></span></a>
                            <a data-bind="click: esEntrada() ? unsetEsEntrada : setEsEntrada, style: { background: esEntrada() ? '#437FBE' : ''}" data-role="button" data-iconpos="notext" data-icon="star" href="#" title="Entrada" data-theme="c" class="ui-btn ui-btn-icon-notext ui-corner-right ui-controlgroup-last ui-btn-up-c"><span class="ui-btn-inner ui-corner-right ui-controlgroup-last"><span class="ui-btn-text">Entrada</span><span class="ui-icon ui-icon-star ui-icon-shadow"></span></span></a>
                         </span>

                         <span data-bind="text: name"></span>

                         <span data-bind="text: cant" class="ui-li-count ui-btn-up-c ui-btn-corner-all"></span>
                     </li>
                 </script>
           </ul>
        </div>    
           
        <div style="width: 70%; display: inline; float: right;">

           <div id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', foreach: currentSubCategorias, afterRender: refreshCategoriasPage} ">
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
                data-bind="template: {name: 'categorias-productos', foreach: currentProductos, afterRender: refreshProductosPage} ">
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

