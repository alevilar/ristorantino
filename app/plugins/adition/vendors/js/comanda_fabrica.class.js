Risto.Adition.comandaFabrica = function(mesa){
    return this.initialize(mesa);
}

cant = 0;
Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    mesa: new Mesa(),
//    productosSeleccionados: ko.observableArray([]),
    detallesComandas: ko.observableArray([]),
    
    
    initialize: function(mesa){       
        this.mesa = mesa;
        this.id = 0;
        this.detallesComandas = ko.observableArray([]);        
        return this;
    },
    
    
    save: function() {
        if ( this.mesa && this.detallesComandas() ) {
            var newComanda = new Risto.Adition.comanda();
            console.debug( this.detallesComandas() );
            newComanda.DetalleComanda( this.detallesComandas() );
            this.mesa.Comanda.unshift( newComanda );
        }
    },
    
    
    __findDetalleComandaPorProducto: function(prod) {
        for( var sdc in this.detallesComandas() ){
            if ( this.detallesComandas()[sdc].Producto().id == prod.id ) {
                return sdc;
            }
        } 
        return -1;
    },
    
    /**
     * Agrega un producto al listado de productos seleccionados
     */
    agregarProducto: function(prod){
        var dc;
        var dcIndex = this.__findDetalleComandaPorProducto(prod);
        
        if ( dcIndex < 0 ) {
            // producto aun no agregado a la lista, entonces lo agrego
            dc = new Risto.Adition.detalleComanda();
            dc.Producto(prod);
            dc.seleccionar();
            this.detallesComandas.unshift(dc);
            return true;
        } else {
            // el producto ya estaba agregado, asique simplemente lo sumo
            this.detallesComandas()[dcIndex].seleccionar();
            return false;
        }
    }
}

