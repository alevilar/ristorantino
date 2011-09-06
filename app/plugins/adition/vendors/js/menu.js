/**
 * @var Static MESAS_POSIBLES_ESTADOS
 * 
 *  esta variable es simplemenete un catalogo de estados posibles que
 *  la mesa pude adoptar en su variable privada this.__estado
 *
 **/
var MENU_ESTADOS_POSIBLES =  {
    productoSeleccionado: {
        msg: 'Producto Seleccionado',
        event: 'productoSeleccionada'
    }
};

Risto.Adition.menu = {
    // listado de categorias anidadas
    categoriasTree: ko.observable(), 
    
    // categoria actualmente activa o seleccionada
    currentCategoria: ko.observable(), 
    
    
    // path de categorias del menu en la que estoy Ej: "/ - Gaseosas - Sin Alcohol""
    path: ko.observableArray([]),
    
    initialize: function(){
        this.__armarMenu();
        Risto.Adition.koAdicionModel.menu(this);
        return this;
    },
    
    update: function(){
        localStorage.removeItem( 'categoriasTree' );
        this.__getRemoteMenu();
    },
    
    __getRemoteMenu: function(){
        var este = this;
        // si no hay categorias las cargo via AJAX
        $.getJSON( urlDomain+'categorias/listar.json', function(data){
            este.__iniciarCategoriasTreeServer(data)
        } );
    },
    
    
    __armarMenu: function(){
        var newDay          = new Date(),
            cantMiliseconds = 86400000; // 86400000 equivalen a 1 dia
        
        // si no paso mas de 1 día, no volver a traer el menu
        if ( localStorage.categoriasTree && localStorage.categoriasTreeDate && (localStorage.categoriasTreeDate - newDay.valueOf() ) < cantMiliseconds) {
            this.__iniciarCategoriasTreeLocalStorage();
        } else {
            this.__getRemoteMenu();
        }
    },
    
    
    __iniciarCategoriasTreeLocalStorage: function(){
         var cats = JSON.parse(localStorage.categoriasTree);
         this.categoriasTree( new Risto.Adition.categoria( cats ) );
         
          // pongo la primer categoria como current
         this.currentCategoria( this.categoriasTree() );
    },
    
    __iniciarCategoriasTreeServer: function(cats){
        var date = new Date();
        localStorage.setItem( 'categoriasTree', ko.toJSON(cats) );
        localStorage.setItem( 'categoriasTreeDate', date.valueOf() );
        this.__iniciarCategoriasTreeLocalStorage();
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
Risto.Adition.menu.currentSubCategorias = ko.dependentObservable(function() {
        if ( this.currentCategoria ) {
            if (this.currentCategoria() && this.currentCategoria().Hijos ) {
                return this.currentCategoria().Hijos;
            }
            return [];
        }
}, Risto.Adition.menu);


Risto.Adition.menu.currentProductos = ko.dependentObservable(function(){
    if ( this.currentCategoria ) {
        if (this.currentCategoria() && this.currentCategoria().Producto ) {
            return this.currentCategoria().Producto;
        }
        return [];
    }
}, Risto.Adition.menu);


Risto.Adition.menu.initialize();