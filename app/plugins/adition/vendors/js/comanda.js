

comanda = {
    categorias: ko.observableArray(), // listado de categorias anidadas
    categoriasPlain: [], // listado donde el KEY del array es el ID de la categoria. Es un hash de categorias
    path: ko.observableArray(), // array con el path de cada categoria seleccionada
    productos : ko.observableArray(),
    currentCategoriaId: ko.observable(1), // id de la categoria actual
    
    refreshPage: function(){
        console.debug('paso');
        
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
            
            $('#ul-categorias').live('click', function(e,t){
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
    
    seleccionarCategoria: function(catId){
        
        this.currentCategoriaId(catId);
    }
                    
}


comanda.currentCategorias = ko.dependentObservable(function() {
        return this.categoriasPlain[this.currentCategoriaId()];
    }, comanda);
