$.mobile.ignoreContentEnabled = true;
// enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
$(document).on('pageshow', '#comanda-add-menu',function(event, ui){ 
    
    
        var AcategoriaActual = null;
        var ULproductos = document.getElementById('listado_productos_categoria_0');
        var enProductoDetalle = null;

        // inicializar listado del Menu con la clase root-ul
        document.getElementById('listado_categorias').firstElementChild.className = 'root-ul';
        
        
        $('a','#listado_productos').on('mouseover', function(){
            if ( enProductoDetalle ) {
                enProductoDetalle.style.display = 'none';
            }
            var href = this.getAttribute('href');
            enProductoDetalle = document.getElementById(href.substring(1));
            enProductoDetalle.style.display = '';                
       });
            
       $('#listado_productos').on('mouseout', 'a', function(){
           setTimeout(function(){
                if ( !enProductoDetalle ) {
                    var href = this.getAttribute('href');                
                    document.getElementById(href.substring(1)).style.display = 'none';
                }
           }, 400);
            
        });
        
        $('#listado_categorias').on('tap', 'a', function(e){
            e.preventDefault();
            
            // inicializar Contenedor de categorias
            var DIV_categoriasContainer = document.getElementById('listado_categorias');
            
            // Ocultar UL de productos anterior
            if (ULproductos) {
                ULproductos.style.display = 'none';
            }
            
            // Hacer cambio de la categoria seleccionada actual
            var AcategoriaAnterior = AcategoriaActual;
            AcategoriaActual = this;
            
            // Mostrar UL de productos
            ULproductos = document.getElementById( this.getAttribute('href').substring(1) );
            if ( ULproductos ) {
                ULproductos.style.display = '';
            }

            // rearmar el menu de categorias si tiene Sublinks <ul>
            if ( AcategoriaActual.nextElementSibling ) {       
                try{
                    var UL_currentCategorias = DIV_categoriasContainer.firstElementChild;
                    var UL_newCategorias = AcategoriaActual.nextElementSibling.cloneNode(true);

                    if ( UL_newCategorias.className != 'root-ul' && UL_newCategorias.children.length && UL_newCategorias.firstElementChild.className != 'bck-btn' ) {
                        // crear boton para volver atras
                        // metiendole el UL anterior                
                        var newLiTitle = document.createElement('li');
                        newLiTitle.className = 'bck-btn';
                        var newATitle = document.createElement('a');
                        newATitle.textContent = AcategoriaActual.textContent;
                        if (AcategoriaAnterior) {
                            newATitle.href = AcategoriaAnterior.getAttribute('href');
                        } else {
                            newATitle.href = '#listado_productos_categoria_0';
                        }
                        
                        newLiTitle.appendChild(newATitle);
                        newLiTitle.appendChild( UL_currentCategorias.cloneNode(true) );

                        //le meto el LI al nuevo UL
                        UL_newCategorias.insertBefore(newLiTitle, UL_newCategorias.firstChild);                
                    }
                    DIV_categoriasContainer.replaceChild(UL_newCategorias, DIV_categoriasContainer.firstElementChild);
                } catch( e ) {
                    console.log(e);
                }              
            }
            return false;
        
        })
        
        $('a','#listado_categorias').on('mouseout', function(e){
            AcategoriaActual = null;
        });


});

// enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
$(document).on('pagehide', '#comanda-add-menu',function(event, ui){ 
  
});