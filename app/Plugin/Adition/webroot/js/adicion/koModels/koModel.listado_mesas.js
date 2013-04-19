// Namespace koModel
Risto.koModel = Risto.koModel = Risto.koModel || {};

Risto.koModel.listado_mesas = {
     // listado de mozos
    mozos: ko.observableArray( [] ),
     // orden del listado de mozos: Se puede poner cualquier valor que venga como atributo (campos de la bbdd de la tabla mozos)
    mozosOrder: ko.observable('numero'),
    
    mesas: ko.observableArray( [] ),
    
    // microtime de la ultima actualizacion de las mesas
    mesasLastUpdatedTime : ko.observable( 0 ),
    
    
    /**
     * Constructor
     */
    initialize: function () {
        var worker = null, // webWorker
            cbk = 0, // contaddor para el for de mesas
            time = ''; // timestamp php que envia el server
            
        if ( Worker ) {  
            
            // Crea el Web Worker
            worker = new Worker(urlDomain + "adition/js/adicion/model.js");
                
            worker.onmessage = function (evt) {
                // si tiene mesas las proceso
                if ( evt.data && evt.data.mesas ) {
                    for ( cbk in evt.data.mesas ) {
                        if ( typeof Risto.handleMesasRecibidas[cbk] == 'function' ) {
                            Risto.handleMesasRecibidas[cbk].call( Risto.koModel.mesa, evt.data.mesas[cbk] );
                        } else {
                            throw cbk + ' vino como opción en el arrar de mesas, pero no es una función válida que pueda manejar el handleMesasRecibidas';
                            Error('no es una funcion');
                        }
                    }
                }

                if ( evt.data.time ) {
                    Risto.koModel.listado_mesas.mesasLastUpdatedTime( evt.data.time );
                }
            }        

            // inicializacion y parametros de configuracion del worker
            worker.postMessage( {updateInterval: Risto.MESAS_RELOAD_INTERVAL} );

            $(window).bind("online", function(){
                 worker.postMessage( {onLine: true} );
            });
            $(window).bind("offline", function(){
                 worker.postMessage( {onLine: false} );
            });


            time = this.mesasLastUpdatedTime();
            worker.postMessage( {urlDomain: urlDomain, timeText: time} );
        }
    },    
    
    
    
    
    /**
     * Busca una mesa por su ID en el listado de mesas
     * devuelve la mesa en caso de encontrarla.
     * caso contrario devuelve false
     * @param id Integer id de la mesa a buscar
     * @return Mesa en caso de encontrarla, false caso contrario
     */
    findMesaById: function(id){
        var m = 0;
        for (m in this.mesas()) {
            if ( this.mesas()[m].id() == id ) {
                return this.mesas()[m];
            }
        }
        return false;
    },
    
    
    
    
    /**
     * Busca un mozo por su ID en el listado de mozos
     * devuelve al objeto Mozo en caso de encontrarlo.
     * caso contrario devuelve false
     * @param id Integer id del Mozo a buscar
     * @return Mozo en caso de encontrarlo, false caso contrario
     */
    findMozoById: function ( id ) {
        var m;
        for (m in this.mozos()) {
            if ( this.mozos()[m].id() == id ) {
                return this.mozos()[m];
            }            
        }
        return false;
    },
    
    
    
    
    ordenarMesasPorNumero: function(){
        return this.mesas().sort(function(left, right) {
            return left.numero() == right.numero() ? 0 : (parseInt(left.numero()) < parseInt(right.numero()) ? -1 : 1) 
        })
    },
    
    
    /**
     *  Crea una mesa
     *  Pasado un JSON con los datos y atributos de una mesa, lo convierte
     *  en un objeto Mesa
     *  @param Mesa mesaJSON
     *  @return Mesa
     */
    crearNuevaMesa: function( mesaJSON ){
        var mozo = this.findMozoById(mesaJSON.mozo_id),
            mesa = new Mesa(mozo, mesaJSON);
        
        return mesa;
    },
    
  
  
   
   
    /**
     *  Abre una mesa
     *  Pasado un JSON con los datos y atributos de una mesa, lo convierte
     *  en un objeto Mesa
     *  @param Mesa mesaJSON
     *  @return Mesa
     */
    abrirNuevaMesa: function( mesaJSON ){
        var mesa = this.crearNuevaMesa(mesaJSON);
        
        Risto.cakeSaver.send({url:urlDomain+'mesas/add.json', obj: mesa});
        return mesa;
    },
    
    
    /**
     *  Devueve todas las mesas qu ehay en el sistema
     *  Concatena las mesas que tiene cada mozo
     *  @return Array
     */
    todasLasMesas : function () {
        var mesasList = [];
        if ( this.mozos ) {
            for ( var m in this.mozos() ) {
                mesasList = mesasList.concat( this.mozos()[m].mesas() );
            }
        }
        return mesasList;
    }
}






