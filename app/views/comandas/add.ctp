    
    <div  data-role="page"  data-add-back-btn="true" id="comanda-add-menu">
        <div  data-role="header"  data-position="inline">
            <h1>Comanda</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div data-role="content">
        
            <script type="text/javascript">
    
                <?php if ( !empty($mesa_id) ) { ?>
                adicion.setCurrentMesa( <? echo $mesa_id?> );
                <?php }?>
                    
                Risto.Adition.comanda.initialize(<?php echo $javascript->object($categorias)?>);
            </script>
            
            
            
           <div id="path" data-bind="template: {name: 'boton', foreach: path, afterRender: refreshPage}">
               <!--  Path buttons template           -->
                <script id="boton" type="text/x-jquery-tmpl">
                    <span>
                    <button
                             data-bind="attr: {'data-icon': esUltimoDelPath()?'':'back', 'data-theme': esUltimoDelPath()?'a':''}" data-icon="back" data-inline="true" data-theme="c" 
                            data-categoria-id="${id}" data-categoria-parent-id="${parent_id}" >${name}</button>
                    </span>
                </script>
           </div> 
            
            
           <div id="ul-productos-seleccionados" style="width: 30%; display: inline; float: left;"
                data-bind="template: {name: 'categorias-productos-seleccionados', foreach: productosSeleccionados}"
                >
               <!-- Productos  Seleccionados template           -->
                 <script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
                     <li data-bind="click: deseleccionar, visible: cant() > 0"><span data-bind="text: name"></span> - <span data-bind="text: cant"></span></li>
                 </script>
           </div>
           
           <div style="width: 70%; display: inline; float: right;" 
                id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', data: currentCategorias, afterRender: refreshPage} ">
               
                <!-- Template de categorias       -->
               <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                    <div>
                        {{each Hijos}}
                        <button style="width: 100px;"  data-icon="forward"  data-role="button" data-inline="true" data-theme="b" 
                                 data-categoria-id="${$value.id}" data-categoria-parent-id="${$value.parent_id}">
                            <?php echo $html->image('ico_mozo.png', array('height'=>'40px'));?>${$value.name}
                            </button>
                        {{/each}}
                    </div>
                </script>
            
            
           </div>
           
           
           <div id="ul-productos" style="clear: both" 
                data-bind="template: {name: 'categorias-productos', foreach: currentProductos,afterRender: refreshPage} ">
                
                <!-- Productos de Categorias template           -->
                 <script id="categorias-productos" type="text/x-jquery-tmpl">
                     <span>
                        <button 
                            data-bind="click: seleccionar, text: name"
                             data-icon="right" data-inline="true" data-theme="e" >
                             </button>
                        
                     </span>
                     
                 </script>

           </div>
        </div>
        
        <div data-role="footer"><h2>Menu footer</h2></div>
    </div>
</div>  
