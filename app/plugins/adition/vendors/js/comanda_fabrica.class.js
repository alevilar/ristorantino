Risto.Adition.comandaFabrica = function(){
    this.initialize(arguments);
}

Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    
    productosSeleccionados: ko.observableArray([]),
    
    
    initialize: function(){
        id = 0;
        this.productosSeleccionados([]);
        
    },
    
    /**
     * Agrega un producto al listado de productos seleccionados
     */
    agregarProducto: function(prod){
        if ( jQuery.inArray( prod, this.productosSeleccionados() ) < 0 ) {
            this.productosSeleccionados.unshift(prod);
            return true;
        } else {
            return false;
        }
    }
}

