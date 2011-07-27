    
    <div  data-role="page"  data-add-back-btn="true" id="comanda-add-menu">
        <div  data-role="header"  data-position="inline">

            <h1>Comanda</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div data-role="content">
            
            <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                <div>
                    {{each Hijos}}
                    <button style="width: 100px;"  data-icon="forward"  data-role="button" data-inline="true" data-theme="b" 
                             data-categoria-id="${$value.Categoria.id}" data-categoria-parent-id="${$value.Categoria.parent_id}">
                        <?php echo $html->image('ico_mozo.png', array('height'=>'40px'));?>${$value.Categoria.name}
                        </button>
                    {{/each}}
                </div>
            </script>
            
            
            <!-- Productos  Seleccionados template           -->
             <script id="categorias-productos-seleccionados" type="text/x-jquery-tmpl">
                 <ul>
                 {{each productosSeleccionados()}}
                 <li>${name} - ${cant}</li>
                 {{/each}}
                 </ul>
             </script>
            
            
             <!-- Productos template           -->
             <script id="categorias-productos" type="text/x-jquery-tmpl">
                 {{each productosDeCategoriaSeleccionada()}}
                 <span>
                    <button data-bind="click: function(){comanda.seleccionarProducto($value)}" data-icon="right" data-inline="true" data-theme="e" 
                            data-categoria-id="${$value.categoria_id}">${$value.name}</button>
                 </span>
                 {{/each}}
             </script>
            
            <!--  Path buttons template           -->
            <script id="boton" type="text/x-jquery-tmpl">
                <span>
                <button
                         data-bind="attr: {'data-icon': esUltimoDelPath()?'':'back', 'data-theme': esUltimoDelPath()?'a':''}" data-icon="back" data-inline="true" data-theme="c" 
                        data-categoria-id="${Categoria.id}" data-categoria-parent-id="${Categoria.parent_id}" >${Categoria.name}</button>
                </span>
            </script>
            
        
            <script type="text/javascript">
    
                <?php if ( !empty($mesa_id) ) { ?>
                adicion.setCurrentMesa( <? echo $mesa_id?> );
                <?php }?>
                    
                comanda.initialize(<?php echo $javascript->object($categorias)?>, <?php echo $javascript->object($productos)?>);
            </script>
            
           <div id="path" data-bind="template: {name: 'boton', foreach: path, afterRender: refreshPage}"></div> 
           <div id="ul-productos-seleccionados" style="width: 30%; display: inline; float: left;"
                data-bind="template: {name: 'categorias-productos-seleccionados'}"
                >
               
           </div>
           
           <div style="width: 70%; display: inline; float: right;" 
                id="ul-categorias" 
                data-bind="template: {name: 'listaCategoriasTree', data: currentCategorias, afterRender: refreshPage} ">
           </div>
           
           
           <div id="ul-productos" style="clear: both" data-bind="template: {name: 'categorias-productos', afterRender: refreshPage} ">
           </div>
        </div>
        
        <div data-role="footer"><h2>Menu footer</h2></div>
    </div>
</div>  
