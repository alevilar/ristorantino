/*-------------------------------------------- Risto.Adicion.comandaFabrica
 *
 * Clase ComandaFabrica
 * 
 */

Risto.comanda.fabrica = function(mesa){
    this.mesa = mesa;
    this.currentSabores = ko.observableArray([]);
    this.comanda = new Risto.comanda();
    
    return this;
}

Risto.comanda.fabrica.prototype = {
    id: 0,
    comandaSettings: {
        imprimir: ko.observable( true ),
        observacion: ko.observable( '' )
    },
    comandaComanderas: {}, // hash de productos seleccionados pero por comandera
    mapeoProductosSeleccionados: {}, // Hash list of productos seleccionados
    productosSeleccionados: ko.observableArray( [] ), //producto temporal (que esta esperando la seleccion de sabores)
   
   
    reset: function(){
        this.comandaComanderas = {};
        this.mapeoProductosSeleccionados = {};
        this.productosSeleccionados =  ko.observableArray( [] );
        this.comandaSettings.imprimir = ko.observable( true );
        this.comandaSettings.observacion = ko.observable( '' );
    },
   
    getComanderaName: function(producto){
        var comanderaName = "comandera_"+producto().comandera_id;

        if ( !this.comandaComanderas.hasOwnProperty()) {
            this.comandaComanderas[comanderaName] = new Risto.comanda( this.comandaSettings );
            this.comandaComanderas[comanderaName].mesa_id = this.mesa.id();
        }
        
        return comanderaName;
    },
    
    
    ponerProductoEnComandera: function(detalleComanda) {
        var cName = this.getComanderaName( detalleComanda.Producto);
        this.comandaComanderas[cName].agregarProducto( detalleComanda.Producto,  detalleComanda.Sabor);
        detalleComanda['comanda'] = this.comandaComanderas[cName];
        return this.comandaComanderas[cName];
    },
    
    /**
     *
     * Inserta el DetalleComanda en la vista de la mesa y las envia ajaxa para guardar
     * inserta tantas comandas como se le hayan pasado de parametro
     * @param comandaJsonCopy Object con los atributos de la comanda
     * @param comanderas Array listado de comandas
     */
    __enviarComandas: function( ){
        console.info("envio comanda");
        var comanderaComanda;
         // creo una nueva comanda para cada comandera
        for (var i in this.comandaComanderas ) {            
            this.mesa.Comanda.unshift( this.comandaComanderas[i] );
            comanderaComanda = this.comandaComanderas[i];
            console.debug(comanderaComanda);
            //  para cada comandera
            Risto.cakeSaver.send({
                url: urlDomain + 'comandas/add.json', 
                obj: comanderaComanda
            });
        }
        this.reset();
    },
    
    
    save: function() {
        console.info("guardolin");
        if ( !this.mesa){
                jQuery.error("no hay una mesa setteada. No se puede guardar una comanda de ninguna mesa");
                return null;
        }
        
        // si la mesa no tiene ID es porque aun no se guardo.. entonces vuelvo 
        // a llamar a este metodo pero dentro de un rato
        var cantRepeticiones = 0;
        if ( !this.mesa.id() ) {
            throw "No se puede guardar Comanda, no hay mesa seleccionada";
            var este = this;
            setTimeout( function(){
                if (cantRepeticiones < 4) {                
                    cantRepeticiones++;
                este.save();
                }
            }, Risto.MESAS_RELOAD_INTERVAL); 
            return null;
        }
        
        this.__enviarComandas();
    },
   
    
    
    /**
     *  Devuelve la comanda correspondiente a la comandera
     *  del producto pasado como paramentro
     *
     * @param json producto el producto que quiero buscarle la comanda 
     * @return Comanda
     */
    __findComandaNameDeProducto: function(producto){
        return this.getComandaComandera(producto.comandera_id);
    },
    
    limpiarSabores: function(){
        this.saboresSeleccionados = [];
        this.productoSaborTmp = {};
    },
    
    saveSabores: function(prod, sabores) {
        this.__doAdd( this.productoSaborTmp, this.saboresSeleccionados );
        
        this.limpiarSabores();
    },
    

    __doAdd: function(prod, sabores){
        var prodIdName = 'producto_'+prod.id,    
            index, // index array number donde esta el dato del producto pasado
            saboresUntuched = sabores;
                
        sabores.sort(function(a,b){
            return a.id - b.id
        });
        
        var sabor_id_concat = '';
        for (var i in sabores){
            sabor_id_concat += sabores[i].id;
        }
        prodIdName += sabor_id_concat;
        // si aun no estaba ese producto
        if ( !this.mapeoProductosSeleccionados.hasOwnProperty(prodIdName) ) {            
            // armo el objeto
            this.mapeoProductosSeleccionados[prodIdName] = new Risto.comanda.detalleComanda({
                Producto: prod,
                Sabor: saboresUntuched,
                productoSeleccionadoIndex: undefined
            });
            this.mapeoProductosSeleccionados[prodIdName].seleccionar();
            
            // lo meto en el array de productos seleccionadls
            index = this.productosSeleccionados.push( this.mapeoProductosSeleccionados[prodIdName] ) - 1;
            
            this.ponerProductoEnComandera( this.mapeoProductosSeleccionados[prodIdName] );
            
            // guardo el indice del array annterior para mayor velocidad
            this.mapeoProductosSeleccionados[prodIdName]['productoSeleccionadoIndex'] = index;
        } else {
            index = this.mapeoProductosSeleccionados[prodIdName]['productoSeleccionadoIndex'];
            var cant = this.productosSeleccionados()[ index ].cant();
            cant++;
            
            this.productosSeleccionados()[ index ].cant(cant);
        }
        return this.productosSeleccionados()[ index ];
    },
    
    
    /**
     * Agrega un producto al listado de productos (DetalleComanda) seleccionados
     */
    agregarProducto: function(prod, sabores){
        var sabor = [];
        if (prod.Sabor && prod.Sabor.length > 0) {
            sabor = prod.Sabor;
        }
        
        if ( sabores  && sabores.length > 0){
            sabor = sabores;
        }
        
        return this.__doAdd(prod, sabor);
    }
    
}