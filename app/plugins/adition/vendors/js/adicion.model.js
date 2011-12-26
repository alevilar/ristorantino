



// inicializacion con parametros enviados desde el instanciador del worker
self.onmessage = function(obj) {
    
    postMessage( obj.data );
    if (obj.data.urlDomain) {
        AditionModel.urlDomain = obj.data.urlDomain;
        
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
        AditionModel.intervalTime = obj.data.updateInterval;
    }
    
    if (!AditionModel.interval) {
        AditionModel.interval = setInterval( AditionModel.getMesas, AditionModel.intervalTime );
    }
    
}



AditionModel = {
    urlDomain : '', 
    timeText : '', 
    adn : '', 
    interval : '', 
    ajaxSending : false,
    mesasLastUpdatedTime : 0,
    anteriorUpdatedTime : 0, // fecha temporal por si fallo el ajax
    firstRun    : true, 
    onLine      : true,
    intervalTime    : 15000,
    
    
    getMesas: function(){
//        if ( onLine ) {
            AditionModel.getRemoteMesasAbiertas();
//        }
    },
    
    getRemoteMesasAbiertas: function () {
        var url = '';
        if (AditionModel.urlDomain) {
            url = AditionModel.urlDomain;
        }
        
        AditionModel.anteriorUpdatedTime = AditionModel.mesasLastUpdatedTime;
        if ( AditionModel.mesasLastUpdatedTime) {
            // si mesasLastUpdatedTime tiene valor es porque ahora solo quiero que me traiga las que fueron actualizadas ultimamente
            url = url + 'mozos/mesas_abiertas/'+ AditionModel.mesasLastUpdatedTime +'.json'
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
    
    _processOnSuccess: function(){

        if (this.readyState == 4 && this.responseText) {
            var data = JSON.parse( this.responseText );
            if (data.time) {
                AditionModel.mesasLastUpdatedTime = data.time;
            } 
            postMessage(data);
            
            AditionModel.ajaxSending = false;
        } else {
            AditionModel.mesasLastUpdatedTime = AditionModel.anteriorUpdatedTime;
        }            
    },
    
    _juntarMesasDeMozos: function( aMozo ){        
        var mesas = [];
        if ( aMozo ) {
            for ( var m in aMozo ) {
                mesas = mesas.concat( aMozo[m].mesas );
            }
        }        
        return mesas;
    },
    
    
    _ordenarMesas: function( aMesas ){
        var order = 'numero';

        if ( order ) {
            aMesas.sort(function(left, right) {
                return left[order] == right[order] ? 0 : (parseInt(left[order]) < parseInt(right[order]) ? -1 : 1) 
            })
        }
        return aMesas;
    }
    
}