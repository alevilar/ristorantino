Risto.Adition.comandaFabrica = function(mesa){
    return this.initialize(mesa);
}

Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    mesa: {},
    
    comanda: {},
    
    // array de los sabores del producto seleccionado
    currentSabores: ko.observableArray([]),
    
    productoSaborTmp: {}, //producto temporal (que esta esperando la seleccion de sabores)
    saboresSeleccionados: [], // listado de sabores seleccionados para el productoSaborTmp
   
    
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

        if ( this.mesa && this.detallesComandas() ) {
            var newComanda = new Risto.Adition.comanda();
            newComanda.DetalleComanda( this.detallesComandas() );
            this.mesa.Comanda.unshift( newComanda );
        }
        
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
    
    saveSabores: function(prod, sabores) {
        $('#page-sabores').dialog('close');
        this.saboresSeleccionados = [];
        this.productoSaborTmp = {};
        
        this.__doAdd( this.productoSaborTmp );
    },
    
    agregarSabor: function( sabor ) {
        this.saboresSeleccionados.push(sabor);
    },
    
    __doAdd: function(prod){
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
            if (this.saboresSeleccionados.length > 0 ) {
                dc.DetalleSabor( this.saboresSeleccionados );
            }
            return true;
        } else {
            // el producto ya estaba agregado, asique simplemente lo sumo
            this.comanda.DetalleComanda()[dcIndex].seleccionar();
            return false;
        }
    },
    
    /**
     * Agrega un producto al listado de productos (DetalleComanda) seleccionados
     */
    agregarProducto: function(prod){
        if ( prod.Categoria.Sabor.length > 0 ) {
            this.productoSaborTmp = prod;
            this.currentSabores( prod.Categoria.Sabor );
//             $('#page-sabores').dialog();             
        } else {
            this.__doAdd(prod);
        }
        
    }
}

