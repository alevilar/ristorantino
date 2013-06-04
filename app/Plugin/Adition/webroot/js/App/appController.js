/**
 * Esta vista funciona como un manejador de vistas.
 * No se encuentra relacionada con la BBDD y no deberia ser utilizada para
 * guardar, modificar o traer objectos del servidor
 *
 */

    
    
App.Controller = (function(){
	
	
	var AppController = Marionette.Controller.extend({
	   
	    
	    categoria: App.observer('app:categoria'),
	                
	    producto:  App.observer('app:producto'),
	                
	    comanda:  App.observer('app:comanda'),
	    
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
