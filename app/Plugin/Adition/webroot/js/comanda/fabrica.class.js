/*--------------------------------------------------------------------------------------------------- Risto.Adicion.comandaFabrica
 *
 *
 * Clase ComandaFabrica
 */

Risto.Adition.comandaFabrica = function(mesa){
    return this.initialize(mesa);
}

Risto.Adition.comandaFabrica.prototype = {
    id: 0,
    mesa: {},
    
    comanda: {},
    
    // array de los sabores del producto seleccionado
    currentSabores: function( ) {return []},
    
    productoSaborTmp: {}, //producto temporal (que esta esperando la seleccion de sabores)
    saboresSeleccionados: [], // listado de sabores seleccionados para el productoSaborTmp
   
   
    
    initialize: function(mesa){
        this.productoSaborTmp = {};
        this.saboresSeleccionados = [];
        this.mesa = mesa;
        this.currentSabores = ko.observableArray([]);
        this.comanda = new Risto.Adition.comanda();
        if ( mesa ) {
            this.comanda.mesa_id = mesa.id();
            this.mesa = mesa;
        }
        this.id = undefined;
        return this;
    },
    
    
    /**
     *
     * Inserta el DetalleComanda en la vista de la mesa y las envia ajaxa para guardar
     * inserta tantas comandas como se le hayan pasado de parametro
     * @param comandaJsonCopy Object con los atributos de la comanda
     * @param comanderas Array listado de comandas
     */
    __generarComanda: function( comandaJsonCopy, comanderas ){
         // creo una nueva comanda para cada comandera
        for (var com in comanderas ) {
            comanderaComanda = new Risto.Adition.comanda( comandaJsonCopy );
            comanderaComanda.DetalleComanda( comanderas[com] );
            this.mesa.Comanda.unshift( comanderaComanda );
            
             //  para cada comandera
            $cakeSaver.send({
                url: urlDomain + 'detalle_comandas/add.json', 
                obj: comanderaComanda
            });
        }
    },
    
    
    save: function() {
        if ( !this.mesa){
                jQuery.error("no hay una mesa setteada. No se puede guardar una comanda de ninguna mesa");
                return null;
        }
        
        // si la mesa no tiene ID es porque aun no se guardo.. entonces vuelvo 
        // a llamar a este metodo pero dentro de un rato
        if ( !this.mesa.id() ) {
            var este = this;
            setTimeout( function(){ 
                este.save();
            }, Risto.MESAS_RELOAD_INTERVAL); 
            return null;
        }
        
        
        // separo la comanda generada en varias comandas
        // se genera 1 comanda por cada impresora que haya (comandera)
        var ccdc;
        var comanderas = [];
        
        // separo los detalleComanda por comandera
        for (var dc in this.comanda.DetalleComanda()) {
            ccdc = this.comanda.DetalleComanda()[dc];
            //si el detalleComanda no tiene cantidad mayor a cero (se agregaron demas por error y luego se quitaron)
            // entonces no debo guardarla
            if ( ccdc.realCant() == 0) continue;
            
            // inicializo la cantidad eliminada para que no sea enviada ni guardada
//            ccdc.cant = ccdc.realCant();
//            ccdc.cant_eliminada = 0;
            
            if ( !comanderas[ccdc.comandera_id()] || !comanderas[ccdc.comandera_id()].length ) {
               comanderas[ccdc.comandera_id()] = [];
            }
            comanderas[ccdc.comandera_id()].push(ccdc);
        }
        
        var comandaJsonCopy = {
                mesa_id: this.mesa.id(),
                observacion: this.comanda.observacion(),
                imprimir: this.comanda.imprimir()
            }
        
        this.__generarComanda(comandaJsonCopy, comanderas);
        
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
        if (sabores === null){
            sabores = [];
        }
        
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
                if ( this.__findDetalleComandaPorSabor(dcIx, sabores) ) {
                    return sdc;
                }
            }
        } 
        return -1;
    },
    
    limpiarSabores: function(){
        this.saboresSeleccionados = [];
//        $('#page-sabores').dialog('close');
    },
    
    saveSabores: function(prod, sabores) {
//        $('#page-sabores').dialog('close');
        
        this.__doAdd( this.productoSaborTmp, this.saboresSeleccionados );
        
        this.saboresSeleccionados = [];
        this.productoSaborTmp = {};
    },
    
    sacarSabor: function(sabor){
       for (var s in this.saboresSeleccionados) {
           if( this.saboresSeleccionados[s].id == sabor.id ) {
               return this.saboresSeleccionados.splice(s,1);
           }          
       }
       return false;
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
            var dcConProd = {Producto : prod};
            dc = new Risto.Adition.detalleComanda(dcConProd);

            // suma 1 al producto
            dc.seleccionar(); 
            
            if (sabores && sabores.length > 0 ) {
                dc.DetalleSabor( sabores );
            }
            
            this.comanda.DetalleComanda.unshift(dc);
            return dc;
        } else {
            // el producto ya estaba agregado, asique simplemente lo sumo
            this.comanda.DetalleComanda()[dcIndex].seleccionar();
            return this.comanda.DetalleComanda();
        }
    },
    
    /**
     * Agrega un producto al listado de productos (DetalleComanda) seleccionados
     */
    agregarProducto: function(prod){
        var sabor = [];
        
        if (prod.Sabor && prod.Sabor.length > 0){
            sabor = prod.Sabor;
        }
        
        if ( prod.Categoria && prod.Categoria.Sabor && prod.Categoria.Sabor.length > 0){
            sabor = prod.Sabor;
        }
        return this.__doAdd(prod, sabor);
        
    }
    
    
}

