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
        
        $cakeSaver.send({url:urlDomain+'detalle_comandas/add', obj: this.comanda});
        
        return this.comanda;
    },
    
    /**
     * Busca sabores dentro e una DetalleComanda. Si los sabores conciden con los del objeto
     * entonces devuelve true
     * 
     * @param DetalleComanda buscarAca objeto donde que contiene DetalleSabor, que es el array donde voy a buscar
     * @param Array sabores listado de sabores que quiero comparar
     * 
     * @return Boolean
     */
    __findDetalleComandaPorSabor: function(buscarAca, sabores) {
        var dcIx;
        var encontrados = 0;
        
        // Si no tienen el mismo tamaño, directamente devolver false y ahorra los foreach
        if ( sabores.length != buscarAca.DetalleSabor().length ) {
            return false;
        }
        
        // comparar cada sabor con el quie esta en el DetalleComanda
        for (var ss in sabores ){
            for (var dc in buscarAca.DetalleSabor() ){
                dcIx = buscarAca.DetalleSabor()[dc];
                if ( dcIx.id == sabores[ss].id ) {
                    encontrados++;
                }
            }
        }
        
        return encontrados == sabores.length;
    },
    
    
    
    /**
     * Busca productos dentro de los productos seleccionados
     * Si un producto ya esta en el listado, en lugar de crear uo nuevo, asiciona 1 unidad a ese producto
     * Si un producto tiene muchos sabores, tambien busca para sumar aqueyos cuyos sabores concidan,
     * Por ejemp0lo. si yo tengo una ensalada de tomate y lechuga ya en mi DetalleComanda,
     * y luego se agrega otro producto con lechuga y tomate, en lugar de crear un nuevo producto en el listado
     * le suma 1 unidad al anterior. Entonces nos quedarán 2 ensaladas de tomate y lechuga
     * @param prod Producto es el objeto que quiero agregar
     * @param sabores Array de Sabor. es el aray de sabores del prod
     * 
     * @return Index del array de DetalleComanda. me devuelve el uindex donde esta la comanda que contiene ese producto con esos sabores.
     * Devuelve -1 si no encontró nada
     *
     */
    __findDetalleComandaPorProducto: function(prod, sabores) {
        var dcIx, prodIndex, saborIndex;
        for( var sdc in this.comanda.DetalleComanda() ){
            dcIx = this.comanda.DetalleComanda()[sdc];
            prodIndex = dcIx.Producto();
            
            if ( prodIndex.id == prod.id ) {
                if ( dcIx.tieneSabores() ) {
                    if ( this.__findDetalleComandaPorSabor(dcIx, sabores) ) {
                        return sdc;
                    }
                } else {
                    return sdc;
                }
            }
        } 
        return -1;
    },
    
    saveSabores: function(prod, sabores) {
        $('#page-sabores').dialog('close');
        
        this.__doAdd( this.productoSaborTmp, this.saboresSeleccionados );
        
        this.saboresSeleccionados = [];
        this.productoSaborTmp = {};
    },
    
    agregarSabor: function( sabor ) {
        this.saboresSeleccionados.push(sabor);
    },
    
    __doAdd: function(prod, sabores){
        var dc;
            
        // checkeo si el producto ya estaba cargado
        var dcIndex = this.__findDetalleComandaPorProducto(prod, sabores);
        
        if ( dcIndex < 0 ) {
            // producto aun no agregado a la lista, entonces lo agrego
            dc = new Risto.Adition.detalleComanda();
            dc.Producto(prod);
            // suma 1 al producto
            dc.seleccionar(); 
            
            if (sabores && sabores.length > 0 ) {
                dc.DetalleSabor( sabores );
            }
            
            this.comanda.DetalleComanda.unshift(dc);
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

