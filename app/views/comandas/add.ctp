        
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
                    
                    
                     ko.applyBindings(Risto.Adition.koAdicionModel, document.getElementById('ul-categorias'));
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
            
            
       <div id="ul-productos-seleccionados" style="width: 30%; display: inline; float: left;" data-role="listview"
            data-bind="template: {name: 'categorias-productos-seleccionados', foreach: productosSeleccionados, afterRender: refreshProductosSeleccionadosPage}"
            >
             <script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
                 <li>
                     <span data-role="controlgroup" data-type="horizontal">
                        <a href="#" data-bind="click: seleccionar" data-iconpos="notext" data-icon="plus" data-role="button">+</a>
                        <a href="#" data-bind="click: deseleccionar" data-iconpos="notext" data-icon="minus" data-role="button">-</a>
                        <a href="#" data-rel="dialog" data-bind="click: addObservacion" data-icon="grid" data-bind="style: { background: observacion() ? '#437FBE' : ''}" data-iconpos="notext" data-role="button">Observación</a>
                        <a href="#" data-icon="star" data-bind="click: esEntrada() ? unsetEsEntrada : setEsEntrada, style: { background: esEntrada() ? '#437FBE' : ''}" data-iconpos="notext" data-role="button">Entrada</a>
                     </span>

                     <span data-bind="text: name"></span>

                     <span data-bind="text: cant" class="ui-li-count"></span>
                 </li>
             </script>

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
                     <a href="#" data-bind="" class="ui-btn ui-btn-inline ui-btn-icon-left ui-btn-corner-all ui-shadow ui-btn-up-e">
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

