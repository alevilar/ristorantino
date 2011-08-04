   
        
        
<div data-role="page" id="comanda-add-menu">
    <div  data-role="header"  data-position="inline">
        <h1>Comanda</h1>
        <a href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
    </div>

    <div data-role="content">
        
         <script type="text/javascript">
            $('#comanda-add-menu').live('pagecreate',function(event){    
                <?php if ( !empty($mesa_id) ) { ?>
                adicion.setCurrentMesa( <? echo $mesa_id?> );
                <?php }?>

                Risto.Adition.comanda.initialize();
            });
        </script>
    
    
            
       <div id="path" data-bind="template: {name: 'boton', foreach: comanda().path, afterRender: comanda().refreshPathPage}">
           <!--  Path buttons template           -->
            <script id="boton" type="text/x-jquery-tmpl">
                <span>
                <button
                        data-bind="attr: {'data-icon': esUltimoDelPath()?'':'back', 'data-theme': esUltimoDelPath()?'a':''}, click: seleccionar" data-icon="back" data-inline="true" data-theme="c" 
                        data-categoria-id="${id}" data-categoria-parent-id="${parent_id}" >${name}</button>
                </span>
            </script>
       </div> 
            
            
       <div id="ul-productos-seleccionados" style="width: 30%; display: inline; float: left;" data-role="listview"
            data-bind="template: {name: 'categorias-productos-seleccionados', foreach: comanda().productosSeleccionados, afterRender: comanda().refreshProductosSeleccionadosPage}"
            >
           <!-- Productos  Seleccionados template           -->
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
                data-bind="template: {name: 'listaCategoriasTree', foreach: comanda().currentSubCategorias, afterRender: comanda().refreshCategoriasPage} ">

                <!-- Template de categorias       -->
               <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                    <span>
                        <a data-role="button" data-inline="true" data-theme="b" 
                                 data-bind="click: seleccionar"
                                 >
                            <?php echo $html->image('ico_mozo.png', array('height'=>'40px'));?><span  data-bind="text: name"></span>
                        </a>
                    </span>
                </script>
                
           </div>
           
           
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: comanda().currentProductos, afterRender: comanda().refreshProductosPage} ">

                <!-- Productos de Categorias template           -->
                 <script id="categorias-productos" type="text/x-jquery-tmpl">
                     <span>
                        <button data-bind="click: seleccionar, text: name"
                                data-icon="right" data-inline="true" data-theme="e" >
                             </button>
                     </span>
                 </script>
           </div>
        </div>
    </div>
        
    <div data-role="footer"><h2>Menu footer</h2></div>
    
</div>  




