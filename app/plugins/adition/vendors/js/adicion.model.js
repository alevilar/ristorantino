

// definicion de variables globales del worker
var urlDomain, 
    timeText, 
    adn, 
    interval, 
    ajaxSending = false,
    mesasLastUpdatedTime = 0,
    firstRun    = true, 
    onLine      = true,
    intervalTime    = 15000;


// inicializacion con parametros enviados desde el instanciador del worker
self.onmessage = function(obj) {
    
    postMessage( obj.data );
    if (obj.data.urlDomain) {
        urlDomain = obj.data.urlDomain;
        
        if (firstRun) {
            // la primera vez hacer esto
            firstRun = false;
            AditionModel.getMesas();
        }
    }    
    
    if (obj.data.onLine !== undefined) {
        onLine = obj.data.onLine;
    }
    if (obj.data.updateInterval !== undefined && obj.data.updateInterval > 0) {
        intervalTime = obj.data.updateInterval;
    }
    
    if (!interval) {
        interval = setInterval( AditionModel.getMesas, intervalTime );
    }
    
}



AditionModel = {
    
    getMesas: function(){
        if ( onLine ) {
            AditionModel.getRemoteMesasAbiertas();
        }
    },
    
    getRemoteMesasAbiertas: function () {
        var url = '';
        if (urlDomain) {
            url = urlDomain;
        }
        
        if ( mesasLastUpdatedTime > 0) {
            url = url + 'mozos/mesas_abiertas/'+ mesasLastUpdatedTime +'.json'
        } else {
            url = url + 'mozos/mesas_abiertas.json';
        }
        
        // si ya no estaba previamente mandando otro ajax igual...
        if ( !ajaxSending ) {
            var xhr = new XMLHttpRequest();
            ajaxSending = true;
            
            // callbacl en caso de exito al recibir el ajax
            xhr.onreadystatechange = this._processOnSuccess;
            
            // mando el ajax pidiendo las mesas
            xhr.open('GET', url, false);
            xhr.send();
        }
    },
    
    _processOnSuccess: function(){
        if (this.readyState == 4 && this.responseText) {
            var data = JSON.parse( this.responseText );
            if (data.time) {
                mesasLastUpdatedTime = data.time;
            }
            
            if (data.mozos.length) {
                // actualizar el storage de mozos
//                var mozos = data.mozos;
                
                // actualizar el storage de mesas
//                var mesas = AditionModel._juntarMesasDeMozos( mozos );
//                mesas = AditionModel._ordenarMesas( mesas );                
//                data.mesas = mesas;
                
                //mandar la nueva data
                postMessage(data);            
            }
            
            ajaxSending = false;
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