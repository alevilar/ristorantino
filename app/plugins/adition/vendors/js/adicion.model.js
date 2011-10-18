
// definicion de variables globales del worker
var urlDomain, 
    timeText, 
    adn, 
    interval, 
    ajaxSending = false,
    mesasLastUpdatedTime = 0,
    firstRun    = true, 
    onLine      = true;


// inicializacion con parametros enviados desde el instanciador del worker
self.onmessage = function(obj) {   
//    postMessage( obj.data );
    if (obj.data.urlDomain) {
        urlDomain = obj.data.urlDomain;
    }    
    if (obj.data.onLine !== undefined) {
        onLine = obj.data.onLine;
    }
    
    if (firstRun) {
        // la primera vez hacer esto
        firstRun = false;
        AditionModel.getMesas();
    }
    
    if (!interval) {
        interval = setInterval( AditionModel.getMesas, 4000 );
    }
    
}



AditionModel = {
    mozos: [],
    mesas: [],
    
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
                postMessage(data);                        
            }
            ajaxSending = false;
        }
    }
}