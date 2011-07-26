    
    <div  data-role="page"  data-add-back-btn="true" id="comanda-add-menu">
        <div  data-role="header"  data-position="inline">

            <h1>Menu</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div data-role="content">
            <script id="listaCategoriasTree" type="text/x-jquery-tmpl">
                 <button data-icon="left" data-inline="true" data-theme="c" 
                         data-categoria-id="${Categoria.id}" data-categoria-parent-id="${Categoria.parent_id}" onclick="">${Categoria.name}</button>
                
                {{each Hijos}}
                    <button data-icon="left" data-inline="true" data-theme="b" 
                         data-categoria-id="${$value.Categoria.id}" data-categoria-parent-id="${$value.Categoria.parent_id}">${$value.Categoria.name}</button>
                {{/each}}
                
                <div class="productos" data-categoria-id="${Categoria.id}">
                {{each Producto}}
                    <button data-icon="left" data-inline="true" data-theme="e" 
                            data-categoria-id="${categoria_id}" onclick="">${name}</button>
                {{/each}}
                </div>

            </script>
            
            <script id="listaCategoriasHijos" type="text/x-jquery-tmpl">
                 <button data-type="categoria" data-icon="left" data-inline="true" data-theme="b" 
                            data-categoria-id="${Categoria.id}">${Categoria.name}</button>
            </script>
            
            
            <script id="listaProductosDeCategoria" type="text/x-jquery-tmpl">
                    <button data-type="producto" data-icon="left" data-inline="true" data-theme="b" 
                            data-categoria-id="${$index}">${$item}</button>
            </script>
            
        
            <script type="text/javascript">
    
                <?php if ( !empty($mesa_id) ) { ?>
                adicion.setCurrentMesa( <? echo $mesa_id?> );
                <?php }?>
                    
                comanda.initialize(<?php echo $javascript->object($categorias)?>, <?php echo $javascript->object($productos)?>);
            </script>


            <h2>Categorias</h2>
           <div id="ul-categorias" data-bind="template: {name: 'listaCategoriasTree', data: currentCategorias, afterRender: refreshPage} "></div>
        </div>
        
        <div data-role="footer"><h2>Menu footer</h2></div>
    </div>
</div>  

    

    <div  data-role="page"  data-add-back-btn="true" id="comanda-data">
        <div  data-role="header"  data-position="inline">

            <h1>Nueva Comanda</h1>
            <a rel="external" href="#listado-mesas" data-icon="home" data-iconpos="notext" data-direction="reverse" class="ui-btn-right">Home</a>
        </div>

        <div  data-role="content" class="">

            <div class="categorias-productos-listado">
                
            </div>


        </div>
        <div  data-role="footer">Ristorantino Mágico</div>
    </div>

