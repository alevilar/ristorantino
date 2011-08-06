

Risto.Adition.comanda = {
    
     // listado de categorias anidadas
    categoriasTree: function(){
        return Risto.Adition.koAdicionModel.categoriasTree.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
    
    // categoria actualmente activa o seleccionada
    currentCategoria: function(){
        return Risto.Adition.koAdicionModel.currentCategoria.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
    
    currentProductos: function(){
        return Risto.Adition.koAdicionModel.currentProductos.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
    
    currentSubCategorias: function(){
        return Risto.Adition.koAdicionModel.currentSubCategorias.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
   
    productosSeleccionados: function(){
        return Risto.Adition.koAdicionModel.productosSeleccionados.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
    
    path: function(){
        return Risto.Adition.koAdicionModel.path.apply(Risto.Adition.koAdicionModel, arguments);
    }, 
    
    
    initialize: function(){
        this.__armarMenu();
        
        // onload
//        $(function(){
//            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-categorias'));
//            ko.applyBindings(Risto.Adition.comanda, document.getElementById('path'));
//            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-productos'));            
//            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-productos-seleccionados'));    
//        });
        return this;
    },
    
    __armarMenu: function(){
        if ( localStorage.categoriasTree) {
            this.__iniciarCategoriasTreeLocalStorage();
        } else {
            var este = this;
            // si no hay categorias las cargo via AJAX
            $.getJSON( urlDomain+'categorias/listar.json', function(data){
                este.__iniciarCategoriasTreeServer(data)
            } );
        }
    },
    
    
    __iniciarCategoriasTreeLocalStorage: function(){
         var cats = JSON.parse(localStorage.categoriasTree);
         this.categoriasTree( new Risto.Adition.categoria( cats ) );
         
          // pongo la primer categoria como current
         this.currentCategoria( this.categoriasTree() );
    },
    
    __iniciarCategoriasTreeServer: function(cats){
        localStorage.categoriasTree = ko.toJSON(cats);
        this.__iniciarCategoriasTreeLocalStorage();
    },
    
    
   
   
   
    /**
     * Agrega un producto al listado de productos seleccionados
     */
    seleccionarProducto: function(prod){
        if ( jQuery.inArray( prod, this.productosSeleccionados() ) < 0 ) {
            this.productosSeleccionados().unshift(prod);
            return true;
        } else {
            return false;
        }
    },

    /**
     * Actualiza la variable observable path
     * en base a la categoria seleccionda
     * @param cat Categoria
     */
    updatePath: function(cat, pathArg, first ){
        var path = pathArg || [];
        var isFirst = true;
        if (first === false) {
            isFirst = false;
        }
       
        cat.esUltimoDelPath = function(){
            return isFirst;
        }
        
        
        if ( cat.hasOwnProperty('Padre') && cat.Padre ) {
             path = this.updatePath(cat.Padre, path, false );
        }
        path.push(cat);
          
        return path;
    },
    
    seleccionarCategoria: function( cat ){   

        this.currentCategoria( cat );
        
        // actualizo el path
        this.path(this.updatePath(cat));
        
        return true;
    }
}
