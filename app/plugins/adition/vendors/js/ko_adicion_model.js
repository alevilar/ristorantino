/**
 *
 *
 *  KO Model
 *  Aca van todos los bindings que se realizaran en la vista
 *
 *  tambien el mapeo de datos entre arrays que vienen del servidor
 *
 *
 */
Risto.Adition.koAdicionModel = {
    currentMozo: ko.observable(),
    currentMesa: ko.observable(),
    
    comanda: ko.observable(),
    
    tieneCurrentMesa: function(){
        if ( typeof this.currentMesa() == 'object')  {
            return true;
        } else {
            return false;
        }
    },
    
    // listado de mozos
    mozos: ko.observableArray(),
    
    // a continuacion indicar el Campo del Model Mesa que sera utilizado para ordenar el listado de mesas
    mozosOrder: ko.observable('mozo_id'),
    
    
    //------------ Comanda ----------------------------------------------//
    
    // listado de categorias anidadas
    categoriasTree: ko.observable(), 
    
    // categoria actualmente activa o seleccionada
    currentCategoria: ko.observable(), 
    
    productosSeleccionados: ko.observableArray([]),
    
    path: ko.observableArray([]),
    
    refreshBinding: function(){
        ko.applyBindings( Risto.Adition.koAdicionModel );
    },
    
    
     refreshProductosPage: function() {
//        $("#ul-productos").find('*').each(function(d, p){
//            $(p).page();
//        });
        
    },
    
    refreshPathPage: function() {
//        $("#path").find('*').each(function(d, p){
//            $(p).page();
//        });
    },
    
    refreshCategoriasPage: function() {
//        $("#ul-categorias").find('*').each(function(d, p){
//            $(p).page('refresh');
//        });
       // $("#ul-categorias").page('refresh');
   
    },
    
    refreshProductosSeleccionadosPage: function() {
//        $('#ul-productos-seleccionados').listview('refresh');
    }
    
    
}


  /*____________________________________ OBSERVABLES DEPENDIENTES ___________________________*/

/******---      ADICION         -----******/
// listado de mesas, depende de las mesas de cada mozo, y el orden que le haya indicado
Risto.Adition.koAdicionModel.mesas = ko.dependentObservable( function(){
                var mesasList = [];
                var order = this.mozosOrder();

                for (var m in this.mozos()) {
                    mesasList = mesasList.concat(this.mozos()[m].mesas());
                }
                
                if ( order ) {
                    mesasList.sort(function(left, right) {
                        return left[order]() == right[order]() ? 0 : (parseInt(left[order]()) < parseInt(right[order]()) ? -1 : 1) 
                    })
                }
                return mesasList;

           }, Risto.Adition.koAdicionModel);
      
      
/******---      COMANDA         -----******/
Risto.Adition.koAdicionModel.currentSubCategorias = ko.dependentObservable(function() {
        if (this.currentCategoria() && this.currentCategoria().Hijos ) {
            return this.currentCategoria().Hijos;
        }
        return [];
    }, Risto.Adition.koAdicionModel);


Risto.Adition.koAdicionModel.currentProductos = ko.dependentObservable(function(){
    if (this.currentCategoria() && this.currentCategoria().Producto ) {
        return this.currentCategoria().Producto;
    }
    return [];
}, Risto.Adition.koAdicionModel);