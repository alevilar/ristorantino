/*--------------------------------------------------------------------------------------------------- Risto.Adicion.adicion
 *
 *
 * Clase Adicion
 * ees el Kernel de la aplicacion
 * se lo suele encontrar muchas veces como objeto adicionar o adn() para simplicar
 */

Risto.Adition.adicionar = {

    yaMapeado: false,
    
    // Mozo Actualmente Activo
    currentMozo: ko.observable( new Mozo() ),
    
    // Mesa Actualmente activa
    currentMesa: ko.observable( new Mesa() ),
    
    // listado de mozos
    mozos: ko.observableArray( [] ),
     // orden del listado de mozos: Se puede poner cualquier valor que venga como atributo (campos de la bbdd de la tabla mozos)
    mozosOrder: ko.observable('mozo_id'),
    
    mesas: ko.observableArray( [] ),
    
    // microtime de la ultima actualizacion de las mesas
    mesasLastUpdatedTime : ko.observable(  ),
    
    // pagos seleccionado de la currentMesa en proceso de pago. es una variable temporal de estado
    pagos: ko.observableArray( [] ),
    
    
    nuevaComandaParaCurrentMesa: function(){
        this.currentMesa().nuevaComanda();
    },
    
    menu: function(){
        return Risto.Adition.koAdicionModel.menu.apply(Risto.Adition.koAdicionModel, arguments);
    },
    

    /**
     * Constructor
     */
    initialize: function() {
        Risto.Adition.adicionar.mozosOrder('numero');
        
        // Crea el Web Worker
        var worker = new Worker("adition/js/adicion.model.js");
        
        var primeraVez = true;
        worker.onmessage = function (evt) {
            
            if ( evt.data && evt.data.mesas ) {
                for ( var cbk in evt.data.mesas ) {
                    if ( typeof Risto.Adition.adicionar.handleMesasRecibidas[cbk] == 'function' ) {
                        Risto.Adition.adicionar.handleMesasRecibidas[cbk].call( Risto.Adition.adicionar, evt.data.mesas[cbk] );
                    } else {
                        throw cbk + ' vino como opción en el arrar de mesas, pero no es una función válida que pueda manejar el handleMesasRecibidas';
                        Error('no es una funcion');
                    }
                }
            }
            
            if ( evt.data.time ) {
                Risto.Adition.adicionar.mesasLastUpdatedTime( evt.data.time );
            }
        }        
        
        worker.postMessage( {updateInterval: MESAS_RELOAD_INTERVAL} );

        $(window).bind("online", function(){
             worker.postMessage( {onLine: true} );
        });
        $(window).bind("offline", function(){
             worker.postMessage( {onLine: false} );
        });
       
        
        var time = this.mesasLastUpdatedTime();
        worker.postMessage( {urlDomain: urlDomain, timeText: time} );
    },    
    
    
   
    /**
     * Me dice si tiene una mesa setteada
     * @return boolean
     */
    tieneMesaSeleccionada: function(){
        var retornar = false;
        if(this.currentMesa){
            if(this.currentMesa.estaAbierta())
                retornar = true;
            else
                retornar = false;
        }
        else{
            retornar = false;
        }
        return retornar;
    },
    
    
    /**
     * Busca una mesa por su ID en el listado de mesas
     * devuelve la mesa en caso de encontrarla.
     * caso contrario devuelve false
     * @param id Integer id de la mesa a buscar
     * @return Mesa en caso de encontrarla, false caso contrario
     */
    findMesaById: function(id){
        for (var m in this.mesas()) {
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
    findMozoById: function(id){
        for (var m in this.mozos()) {
            if ( this.mozos()[m].id() == id ) {
                return this.mozos()[m];
            }            
        }
        return false;
    },
    	
		
    borrarCurrentMesa: function(){
        delete this.currentMesa;
        this.currentMesa = null;
    },

    /**
     * Setter de la currentMesa
     * @param mesa Mesa or Number . Le puedo pasar una Mesa o un Id de la mesa, da lo mismo.
     * @return Mesa o false en caso de que el ID pasado no exista
     */
    setCurrentMesa: function(mesa) {
        if ( typeof mesa == 'number') { // en caso que le paso un ID en lugar del objeto mesa
            mesa = this.findMesaById(mesa);           
        }
        this.currentMesa( mesa );
        if (mesa.mozo) {
            this.setCurrentMozo(mesa.mozo());
        }
        return this.currentMesa();
    },
		


    /**
     * // envia la mesa para ser cerrada
     * @param Boolean cubiertosObligatorios
     **/
    cerrarCurrentMesa: function(cubiertosObligatorios ){
        var cubiertosObs = cubiertosObligatorios || 'undefined';

        if (this.tieneMesaSeleccionada()) {
            // si aun no se settearon la cantidad de comensales DEBE HACERLO !!
            if (cubiertosObs && (this.currentMesa.getCantComensales() == 0) && (this.currentMozo.numero != 99)) {
                    showComensalesWindow();
            } else {
                if(this.tieneMesaSeleccionada()){
                    if(this.currentMesa.productos){
                        var okCerrar = window.confirm("Se va a cerrar la mesa Nº "+this.currentMesa.numero);

                        if ( okCerrar ) {
                            this.currentMesa.cerrar()
                        }
                        return okCerrar;
                    }
                    else{
                        mensajero.error("No se puede cerrar una mesa que no tiene productos cargados.");
                        return -1;
                    }
                }
            } 
        } else {
            mensajero.error("Debe seleccionar una mesa para cerrar.");
            return -2;
        }	
    },


    ticketView: function(elementToUpdate){
        var elem = elementToUpdate || document.createElement('div');
        var url = window.urlDomain+'mesas/ticket_view' + '/'+this.currentMesa.id ;
        return $(elem).load(url);
    },


    cambiarNumeroMesa: function(){
        var numero = prompt('Nuevo Número de Mesa',this.currentMesa.numero);
        var ops = {
                'data[Mesa][numero]': numero
            };
        this.currentMesa.editar(ops);
    },


    setCurrentMozo: function(mozo){
        this.currentMozo( mozo );
        var event = $.Event('adicionCambioMozo');
        event.mozo = mozo;
        $(document).trigger(event);
    },
    
    
    /**
     *
     *  Este objeto maneja las mesas recibidas con el json mozos/mesas_abiertas.json
     *  
     *  Cada uno de los keys, son las claves recibidas en el json que viene de esas mesas recibidas
     *
     */
    handleMesasRecibidas: {
         /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        created: function( data ){
            if (!data.mozos) return -1;

            
            if ( this.mesas().length ) {
                // si ya hay mesas entonces meto las mesas nuevas de forma indidual
                var mozo;
                
                for ( var z in data.mozos ) {
                    mozo = this.findMozoById(  data.mozos[z].id );
                    for ( var m in data.mozos[z].mesas ) {
                        // si no esta en el listado de mesas, la agrego
                        if ( !this.findMesaById( data.mozos[z].mesas[m].id ) ) {
                            new Mesa(mozo, data.mozos[z].mesas[m] );
                        }
                    }
                }
            } else {
                // si no habia mesas, entonces debo hacer todo el proceso de creacion con el mapping
                var mapOps = {
                    'mozos': {
                        create: function(ops) {
                            return new Mozo(ops.data);
                        },
                        key: function(data) {
                            return ko.utils.unwrapObservable(data.id);
                        }
                    }
                }
            
                ko.mapping.fromJS( data, mapOps, Risto.Adition.adicionar );
            }

            $(document).trigger('adicionMesasActualizadas');
        },
        
        
        /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        modified: function( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, 
                mozo;
            for(var z in data.mozos){
                mozo = Risto.Adition.adicionar.findMozoById( data.mozos[z].id );
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.Adition.adicionar.findMesaById( data.mozos[z].mesas[m].id );
                    mesaEncontrada.update( mozo, data.mozos[z].mesas[m]);
                }
            }
            $(document).trigger('adicionMesasActualizadas');
            return 1;
        },
        
        
        /**
         * 
         * Recibiendo las mesas cobradas las manejo 
         * 
         */
        cobradas: function( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, i;
            for (var z in data.mozos) {
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.Adition.adicionar.findMesaById( data.mozos[z].mesas[m].id );
                    i = Risto.Adition.adicionar.mesas().indexOf( mesaEncontrada );
                    ko.mapping.fromJS( data.mozos[z].mesas[m], {}, mesaEncontrada );
                    mesaEncontrada.setEstadoById();
                    setTimeout(function(){
                        var mozo = mesaEncontrada.mozo();
                        mozo.sacarMesa( mesaEncontrada );
                        delete mesaEncontrada;
                    }, 10000);

                }
            }
            
            return 1;
        },
        
        
        /**
         * 
         * Manejo de las mesas eliminadas
         * 
         */
        deleted: function( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, i;
            for (var z in data.mozos) {
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.Adition.adicionar.findMesaById( data.mozos[z].mesas[m].id );
                    if ( mesaEncontrada ) {
                        mesaEncontrada.mozo().sacarMesa( mesaEncontrada );
                        delete mesaEncontrada;
                    }
                }
            }
            $(document).trigger('adicionMesasActualizadas');
            return 1;
        }
    },
    
    
    ordenarMesasPorNumero: function(){
        return this.mesas().sort(function(left, right) {
            return left.numero() == right.numero() ? 0 : (parseInt(left.numero()) < parseInt(right.numero()) ? -1 : 1) 
        })
    },
    
    
    crearNuevaMesa: function( mesaJSON ){
        var mozo = this.findMozoById(mesaJSON.mozo_id);
        var mesa = new Mesa(mozo, mesaJSON);
        
        $cakeSaver.send({url:urlDomain+'mesas/abrirMesa.json', obj: mesa});
        return mesa;
    }
};





/*____________________________________ OBSERVABLES DEPENDIENTES ___________________________*/

/******---      ADICION         -----******/


Risto.Adition.adicionar.todasLasMesas = ko.dependentObservable( function(){
    var mesasList = [];
    if ( this.mozos ) {
        for ( var m in this.mozos() ) {
            mesasList = mesasList.concat( this.mozos()[m].mesas() );
        }
    }
    return mesasList;
}, Risto.Adition.adicionar);

// listado de mesas, depende de las mesas de cada mozo, y el orden que le haya indicado
Risto.Adition.adicionar.mesas = ko.dependentObservable( function(){
                var mesasList = [];
                var order = this.mozosOrder();

                mesasList = this.todasLasMesas();
                
                if ( order ) {
                    mesasList.sort(function(left, right) {
                        return left[order]() == right[order]() ? 0 : (parseInt(left[order]()) < parseInt(right[order]()) ? -1 : 1) 
                    })
                }
                return mesasList;

}, Risto.Adition.adicionar);
     
    
Risto.Adition.adicionar.mesasCerradas = ko.dependentObservable(function(){
    var mesas = [];
    for ( var m in this.mesas() ) {
        if ( !this.mesas()[m].estaAbierta() ) {
            mesas.push( this.mesas()[m]);
        }
    }
    var order = 'time_cerro';
    if ( order ) {
        mesas.sort(function(left, right) {
            if (left[order] && typeof left[order] == 'function' && right[order] && typeof right[order] == 'function') {
                return left[order]() == right[order]() ? 0 : (parseInt(left[order]()) < parseInt(right[order]()) ? -1 : 1) 
            }
        })
    }
                
                
    return mesas;

}, Risto.Adition.adicionar);
     
/**
 * Variable de estado generada cuando se esta armando una comanda
 * son los productos seleccionados
 */
Risto.Adition.adicionar.productosSeleccionados = ko.dependentObservable( function(){
    if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().comanda && this.currentMesa().currentComanda().comanda.DetalleComanda()) {
        return this.currentMesa().currentComanda().comanda.DetalleComanda();    
    } else {
        return [];
    }
    
}, Risto.Adition.adicionar);     


/**
 * Variable de estado generada cuando se esta armando una comanda
 * son los sabores de un producto seleccionado
 */
Risto.Adition.adicionar.currentSabores = ko.dependentObservable( function(){
    if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().currentSabores() ) {
        return this.currentMesa().currentComanda().currentSabores();    
    }
}, Risto.Adition.adicionar);   


// al procesar un pago aqui se escribe el vuelto para manejar en la vista
Risto.Adition.adicionar.vueltoText = ko.dependentObservable( function(){
   var pagos = this.pagos(),
       sumPagos = 0,
       totMesa = Risto.Adition.adicionar.currentMesa().totalCalculado(),
       vuelto = 0,
       retText = 'Total: '+Risto.Adition.adicionar.currentMesa().textoTotalCalculado();
   if (pagos && pagos.length) {
       for (var p in pagos) {
           if ( pagos[p].valor() ) {
            sumPagos += parseFloat(pagos[p].valor());
           }
       }
       vuelto = (totMesa - sumPagos);
       if (vuelto <= 0 ){
           retText = retText+'   -  Vuelto: $  '+Math.abs(vuelto);
       } else {
           retText = retText+'   -  ¡¡¡¡ Faltan: $  '+vuelto+' !!!';
       }
   }
   return retText;
}, Risto.Adition.adicionar);
