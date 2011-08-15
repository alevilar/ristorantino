Risto.Adition.comandaFabrica = function(mesa){
    return this.initialize(mesa);
}

Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    mesa: new Mesa(),
    
    comanda: {},
    
    // array de los sabores del producto seleccionado
    currentSabores: ko.observableArray([]),
    
//    productosSeleccionados: ko.observableArray([]),
//    detallesComandas: ko.observableArray([]),
    
    
    initialize: function(mesa){       
        this.comanda = new Risto.Adition.comanda();
        
        this.mesa = mesa;
        this.id = 0;
        return this;
    },
    
    
    save: function() {
        this.mesa.Comanda.unshift( this.comanda );
        return this.comanda;
    },
    
    
    __findDetalleComandaPorProducto: function(prod) {
        var prodIndex;
        for( var sdc in this.comanda.DetalleComanda() ){
            prodIndex = this.comanda.DetalleComanda()[sdc].Producto();
            if ( prodIndex.id == prod.id ) {
                if ( prodIndex.Sabor ) {
                    
                }
                return sdc;
            }
        } 
        return -1;
    },
    
    /**
     * Agrega un producto al listado de productos (DetalleComanda) seleccionados
     */
    agregarProducto: function(prod){
        var dc;
        
        // checkeo si el producto ya estaba cargado
        var dcIndex = this.__findDetalleComandaPorProducto(prod);
        
        if ( dcIndex < 0 ) {
            // producto aun no agregado a la lista, entonces lo agrego
            dc = new Risto.Adition.detalleComanda();
            dc.Producto(prod);
            // suma 1 al producto
            dc.seleccionar(); 
            this.comanda.DetalleComanda.unshift(dc);
            return true;
        } else {
            // el producto ya estaba agregado, asique simplemente lo sumo
            this.comanda.DetalleComanda()[dcIndex].seleccionar();
            return false;
        }
    }
}

