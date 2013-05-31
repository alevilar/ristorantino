/*--------------------------------------------------------------------------------------------------- Risto
 *
 * Paquete Risto
 */
App = Risto = ( function( Backbone ) {
	
	
	var App = new Backbone.Marionette.Application({
	    regions: {
	    	mainRegion: '#main-region'
	    	},
	    
	    _jqmThemeMap: {
	      "1": 'c', // mesas abiertas
	      "2": 'g', // mesas cerradas
	      "3": 'f'  // mesas cobradas
	    },
	    
	    modo: 'adicionista', // puede ser 'cajero' o 'adicionista'

	                                     
	    formToObject: function($form) {
	        var rta = $form.serializeArray(), 
	        newObj = {}; // json modelo, para crear la mesa
	        for (var r in rta ) {
	            newObj[rta[r].name] = rta[r].value;
	        }
	        return newObj;
	    },
	    
	    
	    findProductoByname: function ( nombre ) {
	        var nomRegex = new RegExp(nombre, 'i'); // i = case insensitive
	        return _.filter(this.productos, function (p) {
	           return  p.name.match(nomRegex) || p.abrev.match(nomRegex);
	        });
	    }	    
	});
	
	App.addInitializer(function(options){
	  App.controller = App.Controller;
	
	  App.addRegions(App.regions);
			
	  App.router = new App.Router;
	  Backbone.history.start();
		            
		//            $.mobile.buttonMarkup.hoverDelay = 0;
		            // Prevents all anchor click handling
		            //        $.mobile.linkBindingEnabled = false;
		
		            // Disabling this will prevent jQuery Mobile from handling hash changes
		            //        $.mobile.hashListeningEnabled = false;
		        
	    $.extend(  $.mobile , {
	        backBtnText: "Volver",
	        defaultPageTransition: 'slide',
	        defaultDialogTransition: 'pop'
	    });
		            
	  // Acts as Mediator Object for the hole application	            
	  App.controller = new App.Controller;          
		            
	});
	
	return App;
	
} )(Backbone, Backbone.Marionette); 



