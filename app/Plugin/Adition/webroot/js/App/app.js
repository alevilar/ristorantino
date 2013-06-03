/*--------------------------------------------------------------------------------------------------- Risto
 *
 * Ristorantino App
 * 
 * Aplicacion que maneja la Adicion del Ristorantino Mágico
 * 
 */
App = ( function( Backbone ) {
	
	
	var App = new Backbone.Marionette.Application({
		
	    regions: {
	    	headerRegion: '#main-header',
	    	contentRegion: '#main-container',
	    	footerRegion: '#main-footer',
	    	dialog: '#dialog',
	    },
	    
	  
	                                     
	    formToObject: function( $form ) 
	    {
	        var rta = $form.serializeArray(), 
	        newObj = {}; // json modelo, para crear la mesa
	        for (var r in rta ) {
	            newObj[rta[r].name] = rta[r].value;
	        }
	        return newObj;
	    },
	    
	    
	    findProductoByname: function ( nombre ) 
	    {
	        var nomRegex = new RegExp(nombre, 'i'); // i = case insensitive
	        return _.filter(this.productos, function (p) {
	           return  p.name.match(nomRegex) || p.abrev.match(nomRegex);
	        });
	    },
	    
	    observer: function ( eventName , initialValue ) 
	    {
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
		},
		
		addCss: function ( cssCode ) 
		{
			var styleElement = document.createElement("style");
			styleElement.type = "text/css";
			if (styleElement.styleSheet) {
			  styleElement.styleSheet.cssText = cssCode;
			} else {
			  styleElement.appendChild(document.createTextNode(cssCode));
			}
			document.getElementsByTagName("head")[0].appendChild(styleElement);
		},
		
		// Run On Start EVENT
		onStart: function ( options )
		{
			  App.controller = App.Controller;
			  App.addRegions(App.regions);
					
			  App.router = new App.Router;
			  Backbone.history.start();
			  
			  $.extend(  $.mobile , {
			      backBtnText: "Volver",
			      defaultPageTransition: 'slide',
			      defaultDialogTransition: 'pop'
			  });
				            
			  // Acts as Mediator Object for the hole application	            
			  App.controller = new App.Controller;   
			  
			  
			  // Set Region as jquery DIALOG
			  App.dialog.on('close', function(){
			  	this.$el.modal('hide');
			  });
			  
			  App.dialog.on('show', function(){
			  	this.$el.modal('show');
			  });
		}

	});
	
	return App;
	
} )( Backbone, Backbone.Marionette ); 



