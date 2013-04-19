/**
 *
 *  Este objeto maneja las mesas recibidas mediante el llamado 
 *  al json mozos/mesas_abiertas.json
 *  
 *  Cada uno de los keys, son las claves recibidas en el json que viene de esas mesas recibidas
 *
 */
Risto.handleMesasRecibidas = {
         /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        created: function ( data ) {
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
            
                ko.mapping.fromJS( data, mapOps, Risto.koModel.mesa );
            }

            Risto.EventHandler.adicionMesasActualizadas();
        },
        
        
        /**
         * 
         * Recibiendo un json con el listado de mozos, que a su vez 
         * cada uno tiene el listado de mesas abiertas de c/u, actualiza 
         * el listado de mesas de la adicion
         * 
         */
        modified: function ( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, 
                mozo;
            for(var z in data.mozos){
                mozo = Risto.koModel.listado_mesas.findMozoById( data.mozos[z].id );
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.koModel.listado_mesas.findMesaById( data.mozos[z].mesas[m].id );
                    if ( mesaEncontrada ) {
                        mesaEncontrada.update( mozo, data.mozos[z].mesas[m] );
                    }
                }
            }
            Risto.EventHandler.adicionMesasActualizadas();
            return 1;
        },
        
        
        /**
         * 
         * Recibiendo las mesas cobradas las manejo 
         * 
         */
        cobradas: function ( data ) {
            if (!data.mozos) return -1;
            var mesaEncontrada, 
                z; // contador index de mozos
                       
            for (z in data.mozos) {
                for( var m in data.mozos[z].mesas ) {
                    mesaEncontrada = Risto.koModel.listado_mesas.findMesaById( data.mozos[z].mesas[m].id );
                    
                    if ( mesaEncontrada ) {  
//                        ko.mapping.fromJS( data.mozos[z].mesas[m], {}, mesaEncontrada );
                        mesaEncontrada.setEstadoCobrada();
                    }
                }
            }
            // reinicializar vistas
            Risto.EventHandler.adicionMesasActualizadas();
            return 1;
        },
        
        
        /**
         * 
         * Manejo de las mesas eliminadas
         * 
         */
        deleted: function(){
            return Risto.handleMesasRecibidas.cobradas();
        }
        
}
    
    