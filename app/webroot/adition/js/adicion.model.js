/**
 *  Web Worker
 *  
 *  Se encarga de gestionar las mesas. Ejecuta un setInterval para recibir
 *  actualizaciones y reenviarselas a la aplicacion cuando el servidor
 *  haya enviado nuevas actualizaciones.
 *  Hace de nexo entre la aplicacion y el servidor PHP
 *
 *
 */



/**
 *
 *  Es el Objeto que aplica la logica necesaria para obtener mesas del servidor
 *
 */
var AditionModel = {
    /**
     * Parametros de configuracion
     */
    config : {
        /**
         * @param {String} url a donde buscar las mesas
         */
        urlDomain : '',
        /**
         * @param {Integer} cantidad de milisegundos entre las llamadas ajax 
         * para buscar las mesas
         */
        intervalTime : 15000
    },
    
    /**
     *  @param {Boolean} ajaxSending es un flag que avisa si ya hay un ajax enviando
     */
    ajaxSending : false,
    
    /**
     *  @param {Number} mesasLastUpdatedTime tiempo en milisegundos desde que se actualizaron las mesas
     */
    mesasLastUpdatedTime : 0,
    
    /**
     *·@param {Number} anteriorUpdatedTime, fecha temporal por si falla el ajax, 
     * retorna el mesasLastUpdatedTime al valor anterior
     */
    anteriorUpdatedTime : 0,
    
    /**
     * @param {Boolean} firstRun es un flag que indica cuando ya se envio el primer ajax
     */
    firstRun    : true, 
    
    /**
     * @param {Boolean} onLine, parcialmente implementado. 
     * La idea es que la aplicacion siga funcionando, inlcuso cuando este offline.
     * Por ese motivo es que la aplicacion debe enviar un aviso de que la aplicacion esta offline
     * para que se active este flag y el Worker no vaya  abuscar las mesas al servidor
     * causando error de conexion.
     */
    onLine      : true,    interval    : '',
    
    
    cantMesas   : 0,
    
    
    /**
     *  Cuando funcione el onLine, debera aplica la logica de ir a buscar las mesas
     *  pero solo cuando este online, caso contrario debera saber manejar la situacion
     *  sin que la applicacion se de cuenta si esta o no offline
     */
    getMesas: function () {
        self.postMessage("buscando mesas");
    //        if ( onLine ) {
            AditionModel.getRemoteMesasAbiertas();
    //        }
    },
    
    
    /**
     *  Esta funcion es la que ejecuta el ajax que va a devolver las mesas
     */
    getRemoteMesasAbiertas: function () {
        var url = '',
            cfg = AditionModel.config;
        
        if (cfg.urlDomain) {
            url = cfg.urlDomain;
        }
        
        AditionModel.anteriorUpdatedTime = AditionModel.mesasLastUpdatedTime;
        if ( AditionModel.mesasLastUpdatedTime) {
            // si mesasLastUpdatedTime tiene valor es porque ahora solo quiero que me traiga las que fueron actualizadas ultimamente
            url = url + 'mozos/mesas_abiertas/'+ AditionModel.mesasLastUpdatedTime;
            
            if ( AditionModel.cantMesas > 0 ) {
                url = url + '/' + AditionModel.cantMesas;
            }
            
            url += '.json';
        } else {
            // traer todas
            url = url + 'mozos/mesas_abiertas.json';
        }
        
        // si ya no estaba previamente mandando otro ajax igual...
        if ( !AditionModel.ajaxSending ) {
            var xhr = new XMLHttpRequest();
            AditionModel.ajaxSending = true;
            
            // callbacl en caso de exito al recibir el ajax
            xhr.onreadystatechange = this._processOnSuccess;
            
            try
              {
                // mando el ajax pidiendo las mesas
                xhr.open('GET', url, false);
                xhr.send();
              }
            catch(err)
              {
                  // si hubo algun error dejo el timestamp anterior, para volver a pedir las mesas
                  AditionModel.mesasLastUpdatedTime = AditionModel.anteriorUpdatedTime;
              }
            
        }
    },
    
    
    /**
     *  Callback del ajax onSuccess, será ejecutado luego de recibir las mesas
     *  via ajax.
     *  Si esta todo bien, envia las mesas a la aplicacion
     */
    _processOnSuccess: function () {
        if (this.readyState == 4 && this.responseText) {
            var data = JSON.parse( this.responseText );
            if (data.time) {
                AditionModel.mesasLastUpdatedTime = data.time;
            } 
            
            
            if ( data.mesas ) {
                AditionModel.cantMesas = 0;
                
                if ( data.mesas.created ) {
                    for ( var m = 0 in data.mesas.created.mozos ) {
                        AditionModel.cantMesas += data.mesas.created.mozos[m].mesas.length;
                    }

                }
                if ( data.mesas.modified ) {
                    for ( var m = 0 in data.mesas.modified.mozos ) {
                        AditionModel.cantMesas += data.mesas.modified.mozos[m].mesas.length;
                    }

                }
            }
            
            
            
            // envio las mesas a la aplicacion
            self.postMessage(data);
            
            AditionModel.ajaxSending = false;
        } else {
            // si hubo error, vuelvo el tiempo atras
            AditionModel.mesasLastUpdatedTime = AditionModel.anteriorUpdatedTime;
        }            
    }
}



/**
 * Se recibe el atributo "data" desde la aplicacion y mediante esta funcion
 * se procesa.
 * Esta funcion es del worker y sirve como nexo para recibir objetos desde la 
 * aplicacion
 * 
 * @param {Object} obj es el objeto evento pasado en el worker
 */ 
self.onmessage = function (obj) {
    var cfg = AditionModel.config;
    
    if (obj.data.urlDomain) {
        cfg.urlDomain = obj.data.urlDomain;
        
        if (AditionModel.firstRun) {
            // la primera vez hacer esto
            AditionModel.firstRun = false;
            AditionModel.getMesas();
        }
    }    
    
    if (obj.data.onLine !== undefined) {
        AditionModel.onLine = obj.data.onLine;
    }
    if (obj.data.updateInterval !== undefined && obj.data.updateInterval > 0) {
        cfg.intervalTime = obj.data.updateInterval;
    }
    
    if (!AditionModel.interval ) {
        AditionModel.interval = setInterval( "AditionModel.getMesas()", cfg.intervalTime );
    }
    
}
