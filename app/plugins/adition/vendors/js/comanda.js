

Risto.Adition.comanda = {
    id: 0,
    
      //------------ Comanda ----------------------------------------------//
    
    // listado de categorias anidadas
    categoriasTree: ko.observable(), 
    
    // categoria actualmente activa o seleccionada
    currentCategoria: ko.observable(), 
    
    productosSeleccionados: ko.observableArray([]),
    
    path: ko.observableArray([]),
    
    
    initialize: function(){
        this.__armarMenu();
        Risto.Adition.koAdicionModel.currentMesa().currentComanda(this);
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
            this.productosSeleccionados.unshift(prod);
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


/******---      COMANDA         -----******/
Risto.Adition.comanda.currentSubCategorias = ko.dependentObservable(function() {
        if (this.currentCategoria() && this.currentCategoria().Hijos ) {
            return this.currentCategoria().Hijos;
        }
        return [];
    }, Risto.Adition.comanda);


Risto.Adition.comanda.currentProductos = ko.dependentObservable(function(){
    if (this.currentCategoria() && this.currentCategoria().Producto ) {
        return this.currentCategoria().Producto;
    }
    return [];
}, Risto.Adition.comanda);