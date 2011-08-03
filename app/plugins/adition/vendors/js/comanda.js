

Risto.Adition.comanda = {
    categoriasTree: ko.observable(), // listado de categorias anidadas
    
    currentCategoria: ko.observable(), // categoria actualmente activa o seleccionada
   
    productosSeleccionados: ko.observableArray([]),
    
    path: ko.observableArray([]),
    
    
    initialize: function(){
        this.__armarMenu();
        
        // onload
        $(function(){
            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-categorias'));
            ko.applyBindings(Risto.Adition.comanda, document.getElementById('path'));
            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-productos'));            
            ko.applyBindings(Risto.Adition.comanda, document.getElementById('ul-productos-seleccionados'));            
            
        });
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
         this.categoriasTree( new Risto.Adition.categoria(JSON.parse(localStorage.categoriasTree) ) );
         
          // pongo la primer categoria como current
         this.currentCategoria( this.categoriasTree() );
    },
    
    __iniciarCategoriasTreeServer: function(cats){
        localStorage.categoriasTree = ko.toJSON(cats);
        this.__iniciarCategoriasTreeLocalStorage();
    },
    
    
    refreshProductosPage: function() {
        $("#ul-productos").find('*').each(function(d, p){
            $(p).page();
        });
        
    },
    
    refreshPathPage: function() {
        $("#path").find('*').each(function(d, p){
            $(p).page();
        });
    },
    
    refreshCategoriasPage: function() {
        $("#ul-categorias").find('*').each(function(d, p){
            $(p).page();
        });
    },
    
    
    
    /**
     * Agrega un producto al listado de productos seleccionados
     */
    seleccionarProducto: function(prod){
        if ( !jQuery.inArray(prod, this.productosSeleccionados) ) {
            this.productosSeleccionados.push(prod);
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
            console.info("actualizando path");
             path = this.updatePath(cat.Padre, path, false );
        }
         console.debug(path);
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


/*____________________________________ OBSERVABLES ___________________________*/

Risto.Adition.comanda.currentSubCategorias = ko.dependentObservable(function() {
        if (this.currentCategoria() && this.currentCategoria().Hijos ) {
            return this.currentCategoria().Hijos();
        }
        return [];
    }, Risto.Adition.comanda);


Risto.Adition.comanda.currentProductos = ko.dependentObservable(function(){
    if (this.currentCategoria() && this.currentCategoria().Producto ) {
        return this.currentCategoria().Producto();
    }
    return [];
}, Risto.Adition.comanda);

