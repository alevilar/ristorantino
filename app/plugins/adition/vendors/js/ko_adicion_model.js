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
    currentMozo: ko.observable(new Mozo()),
    currentMesa: ko.observable(new Mesa()),
    
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
    
    menu: ko.observable( Risto.Adition.menu ),
    
    refreshBinding: function(){
        ko.applyBindings( Risto.Adition.koAdicionModel );
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
     
