

Risto.Adition.comanda = {
    categorias: ko.observableArray(), // listado de categorias anidadas
    categoriasPlain: [], // listado donde el KEY del array es el ID de la categoria. Es un hash de categorias
    
    path: ko.observableArray([]), // array con el path de cada categoria seleccionada
   
    currentCategoriaId: ko.observable(1), // id de la categoria actual,
    
    productosSeleccionados: ko.observableArray(), // productos que se les hizo click o se los seleccionó
    
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
    mapp: function(categorias) {
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
        
        console.debug(viewModel);
        
        this.categorias(new Risto.Adition.categoria(categorias));
    },
    
    
    initialize: function(categorias){
        var comanda = Risto.Adition.comanda;
        console.debug(categorias);
        this.mapp(categorias);
        
        this.aplanarCategorias();
        this.currentCategoriaId(this.categorias().Categoria.id() );
        
        // si no hay categorias las cargo via AJAX
        if ( !this.categorias() ) {
            var este = this;
            $.get(urlDomain+'categorias/listar.json', function(d){
                este.categorias(d);
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
    
    
    aplanarCategorias: function(catList){
        // para la recursividad tomo catList, la primera vez tomo this.categorias()
        var categorias = catList || [this.categorias()];
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
    
    seleccionarProducto: function(index){
        
        var prod = this.productosDeCategoriaSeleccionada()[index];
        
        prod.seleccionar();
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


Risto.Adition.comanda.productosDeCategoriaSeleccionada = ko.dependentObservable(function(){
    if ( this.categoriasPlain[this.currentCategoriaId()] && this.categoriasPlain[this.currentCategoriaId()].Producto ) {
        return this.categoriasPlain[this.currentCategoriaId()].Producto;
    }
}, Risto.Adition.comanda);



