/**
 * Esta vista funciona como un manejador de vistas.
 * No se encuentra relacionada con la BBDD y no deberia ser utilizada para
 * guardar, modificar o traer objectos del servidor
 *
 */

var observer = function (eventName, initialValue) {
    var _latestValue = initialValue;
    function observable() {
        if (arguments.length > 0) {
            // Write
            R$.app.trigger(eventName, arguments[0]);
            if ( arguments[0].hasOwnProperty('id') ) {
                R$.app.trigger(eventName+'.id'+arguments[0].id, arguments[0]);
            }
            // Ignore writes if the value hasn't changed
            _latestValue = arguments[0];
            return this; // Permits chained assignments
        }
        else {
            // Read
            return _latestValue;
        }
    }
    return observable;
}
    
    
R$.app = {
    /**
     * Current Mesa
     */
    mesa: observer('app:mesa'),
    
    categoria: observer('app:categoria'),
                
    producto:  observer('app:producto'),
                
    comanda:  observer('app:comanda'),
                
    resetState: function () {
        var newComanda = new R$.Collection.Comanda({
            mesa_id: this.get('mesa')
        });
            
        this.set('comanda', newComanda);
    }
}

_.extend(R$.app, Backbone.Events);
    
