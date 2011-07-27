

var comanda = {
    categorias: ko.observableArray(), // listado de categorias anidadas
    categoriasPlain: [], // listado donde el KEY del array es el ID de la categoria. Es un hash de categorias
    path: ko.observableArray([]), // array con el path de cada categoria seleccionada
    productos : ko.observableArray(),
    currentCategoriaId: ko.observable(1), // id de la categoria actual
    
    refreshPage: function() {
        
        var newDiv = $("#ul-categorias");
        newDiv.find('*').each(function(d, p){
            $(p).page();
        });
        
        var newDiv = $("#path");
        newDiv.find('*').each(function(d, p){
            $(p).page();
        });
    },
    
    
    initialize: function(categorias, productos){
        this.categorias(categorias);
        this.productos(productos);
        
        
        this.aplanarCategorias();
        this.currentCategoriaId(this.categorias().Categoria.id);
        
        
        
//        var este = this;
//        $.get(urlDomain+'categorias/listar.json', function(d){
//            este.categorias(d);
//        });
        
        // onload
        $(function(){
            ko.applyBindings(comanda, document.getElementById('ul-categorias'));
            ko.applyBindings(comanda, document.getElementById('path'));
            
            $('#ul-categorias').live('click', function(e){
                comanda.seleccionarCategoria( $(e.target).attr('data-categoria-id') );
            });
            
            $('#path').live('click', function(e){
                comanda.seleccionarCategoria( $(e.target).attr('data-categoria-id') );
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
            this.categoriasPlain[cat.Categoria.id] = cat;

            // si tiene hijos, hago recursividad
            if (cat.hasOwnProperty('Hijos')){
                if (cat.Hijos.length) {
                    this.aplanarCategorias(cat.Hijos);
                }
            }
            
        }
    },
    
    seleccionarProducto: function(prod){
        console.info("adentroooo");
        console.debug(prod);
    },
    
    updatePath: function(catId){       
        this.path.unshift(this.categoriasPlain[catId]);
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


comanda.currentCategorias = ko.dependentObservable(function() {
        return this.categoriasPlain[this.currentCategoriaId()];
    }, comanda);
