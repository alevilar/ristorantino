/**
 * Esta vista funciona como un manejador de vistas.
 * No se encuentra relacionada con la BBDD y no deberia ser utilizada para
 * guardar, modificar o traer objectos del servidor
 *
 */

    
    
App.Controller = (function(){
	
		
	function observer (eventName, initialValue) {
	    var _latestValue = initialValue;
	    function observable() {
	        if (arguments.length > 0) {
	            // Write
	            App.app.trigger(eventName, arguments[0]);
	            if ( arguments[0].hasOwnProperty('id') ) {
	                App.app.trigger(eventName+'id:'+arguments[0].id, arguments[0]);
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
	
	var AppController = Marionette.Controller.extend({
	    /**
	     * Current Mesa
	     */
	    mesa: observer('app:mesa'),
	    
	    categoria: observer('app:categoria'),
	                
	    producto:  observer('app:producto'),
	                
	    comanda:  observer('app:comanda'),
	    
	//    mesasCollection : new App.Collection.Mesas,
	    
	//    listadoMesasView : new App.View.ListadoMesas,
    //    currentMesaView : new App.View.Mesa,
	                
	    resetState: function () {
	        var newComanda = new App.Collection.Comanda({
	            mesa_id: this.get('mesa')
	        });
	            
	        this.set('comanda', newComanda);
	    }
	});
	
	return AppController;
})()    
