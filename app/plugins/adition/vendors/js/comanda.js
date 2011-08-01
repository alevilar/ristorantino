

Risto.Adition.comanda = {
    categoriasTree: ko.observableArray(), // listado de categorias anidadas
    
    categoriasPlain: [], // listado donde el KEY del array es el ID de la categoria. Es un hash de categorias
    
    path: ko.observableArray([]), // array con el path de cada categoria seleccionada
   
    currentCategoriaId: ko.observable(1), // id de la categoria actual,
    
    productosSeleccionados: ko.observableArray(),
    __idProductosSeleccionados: {}, // listado de IDs de productos seleccionados, sirve para optimiazr la velocidad de js
    
    refreshPage: function() {
        
        var newDiv = $("#ul-categorias");
        newDiv.find('*').each(function(d, p){
            $(p).page();
        });
        
        var prodDiv = $("#ul-productos");
        prodDiv.find('*').each(function(d, p){
            $(p).page();
        });
        
        var otroDiv = $("#path");
        otroDiv.find('*').each(function(d, p){
            $(p).page();
        });
    },
    
    // mapea las categorias y los productos con knockout mapping
    __mapp: function(categorias) {
        var ob = {
            categorias : categorias
        }
        
        var mappingOps = {
            'categorias': {
                key: function(data) {
                    return ko.utils.unwrapObservable(data.id);
                },
                create: function(options) {
                    return new Risto.Adition.categoria(options.data);
                }
            }
        }        
        
        var viewModel = ko.mapping.fromJS(ob, mappingOps);
        
        this.categoriasTree(new Risto.Adition.categoria(categorias));
    },
    
    
    initialize: function(categorias){
        var comanda = Risto.Adition.comanda;
        this.__mapp(categorias);
        
        this.__aplanarCategorias();
        this.currentCategoriaId(this.categoriasTree().id() );
        
        // si no hay categorias las cargo via AJAX
        if ( !this.categoriasTree() ) {
            var este = this;
            $.get(urlDomain+'categorias/listar.json', function(d){
                este.categoriasTree(d);
            });
        }
       
        
        // onload
        $(function(){
            ko.applyBindings(comanda, document.getElementById('ul-categorias'));
            ko.applyBindings(comanda, document.getElementById('path'));
            ko.applyBindings(comanda, document.getElementById('ul-productos'));            
            
            ko.applyBindings(comanda, document.getElementById('ul-productos-seleccionados'));            
            
            
            $('#ul-categorias').live('click', function(e){
                if ($(e.target).attr('data-categoria-id')) {
                    comanda.seleccionarCategoria( $(e.target).attr('data-categoria-id') );
                    return false
                }
                return true;
            });
            
            $('#ul-productos').live('click', function(e){
                if ($(e.target).attr('data-categoria-id')) {
//                    comanda.seleccionarProducto( $(e.target).attr('data-categoria-id') );
                    return false
                }
                return true;
            });
            
            $('#path').live('click', function(e){
                if ($(e.target).attr('data-categoria-id')) {
                    comanda.seleccionarCategoria( $(e.target).attr('data-categoria-id') );
                    return false
                }
                return true;
            });
            
        });
        
        return this;
    },
    
    
    /**
     * Recorre recursivemante las categoras para listaras en un HASH y optimizar su busqueda
     * @param catList Array Tree de categorias, si no le paso nada toma el atruibuto "categoriasTree" 
     * 
     */
    __aplanarCategorias: function(catList){
        // para la recursividad tomo catList, la primera vez tomo this.categorias()
        var categorias = catList || [this.categoriasTree()];
        for (var c in categorias){
            var cat = categorias[c];
            // meto en array como KEY el ID de categoria
            this.categoriasPlain[cat.id()] = cat;
            
            // si tiene hijos, hago recursividad
            if (cat.hasOwnProperty('Hijos')){
                if (cat.Hijos.length) {
                    this.aplanarCategorias(cat.Hijos);
                }
            }
        }
    },
    
    
    /**
     * Agrega un producto al listado de productos seleccionados
     */
    seleccionarProducto: function(prod){
        if ( !this.__idProductosSeleccionados[prod.id()] ) {
            this.productosSeleccionados.push(prod);
            this.__idProductosSeleccionados[prod.id()] = true;
        } else {
            return false;
        }
    },

    
    updatePath: function(catId){     
        var comanda = Risto.Adition.comanda;
        
        console.debug(catId);
        console.debug(this.categoriasPlain[catId]);
        var categ = this.categoriasPlain[catId];
        
        // le agrego esta funcion que despues utilizo en el tamplate de knockout para manejar la visualizacion
        categ.esUltimoDelPath = function(){
            if ( comanda.path().length ) {
                if ( this.Categoria.id == comanda.path()[comanda.path().length-1].Categoria.id ) {
                      return true
                  } else {
                      return false
                  }
            }
        };
        this.path.unshift(categ);
        if ( this.categoriasPlain[catId].Categoria.parent_id ) {
            this.updatePath(this.categoriasPlain[catId].Categoria.parent_id);
        }
    },
    
    seleccionarCategoria: function(catId){
        // si estoy en la misma que hago click, entonces no hacer nada
        if ( this.currentCategoriaId() == catId ) {
            return false;
        }
        
        this.path([]); // reinicio el array observable
        this.updatePath(catId); // actualizo el path
        this.currentCategoriaId(catId); // setteo el observable
    }

}


Risto.Adition.comanda.currentCategorias = ko.dependentObservable(function() {
        return this.categoriasPlain[this.currentCategoriaId()];
    }, Risto.Adition.comanda);


Risto.Adition.comanda.currentProductos = ko.dependentObservable(function(){
    if ( this.categoriasPlain[this.currentCategoriaId()] && this.categoriasPlain[this.currentCategoriaId()].Producto ) {
        return Risto.Adition.comanda.currentCategorias().Producto();
    } else {
        return [];
    }
}, Risto.Adition.comanda);


