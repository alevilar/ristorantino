Risto.Adition.comanda = function(jsonData){
    this.DetalleComanda = ko.observableArray([]);
    return this.initialize( jsonData );
}


Risto.Adition.comanda.prototype = {
    DetalleComanda : ko.observableArray([]),
    
    initialize: function(jsonData) {
        if ( jsonData ) {
            // si aun no fue mappeado
            var mapOps = {
                'DetalleComanda': {
                    create: function(ops) {
                        return new Risto.Adition.detalleComanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable(data.id);
                    }
                }
            }
            return ko.mapping.fromJS(jsonData, mapOps, this);
        }
        return this;
    },
    
    agregarProductos: function( listProductos ){
        // creo un nuevo detalleComanda con cada Producto
        var dc, p;
        for(var p in listProductos) {
            dc = new Risto.Adition.detalleComanda();
            p  = new Risto.Adition.producto( listProductos[p] );

            dc.Producto = p;
        }
        this.DetalleComanda.unshift( dc ) ;
    }
    
}