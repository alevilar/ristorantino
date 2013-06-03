( function ( App ) {
	
	var mesaApp = App.module("mesaApp");
	
	// init where to store views, models and collection´s class
	mesaApp.View = {};
	mesaApp.Model = {}; 
	mesaApp.Collection = {};
	
	// Marionette Collection
	mesaApp.mozosMesas = [];
	
	
	// listado de "Vistas" cuyo Layout del modulo es el padre. O sea, las paginas hijas.
	var mozosView, // Main View
		mesaAdd,
		mesaDetail;
	
	/** 
	 * 	 Adss private objects for actins as Mediator
	 */
	// current mesa
	mesa: App.observer('mesaApp:mesa'),
	
	
	mesaApp.on('start', function(){
		// load data
		mesaApp.mozosMesas = new mesaApp.Collection.Mozos;
		
		// create main views
		mozosView = new mesaApp.View.MozosView( {collection: mesaApp.mozosMesas} );
		
		// Load Mesas
		mesaApp.mozosMesas.fetch().success(function(){
			App.contentRegion.show(mozosView);
		});
		
		
		mesaApp.listenTo(mozosView, 'itemview:mozo:selected ', function( e , view ) {
				var mozoModel = view.model;
				var mesaFormView = new mesaApp.View.MesaFormView({model: mozoModel});
				mesaFormView.on('submit', function( data ) {
					var mesaObj = App.formToObject( data.view.$('form') );
					App.dialog.close(mesaFormView);
					mozoModel.get('mesas').create(mesaObj);	
				});
				App.dialog.show(mesaFormView);
			});	
	});
	
	mesaApp.on('all', function(a){console.log("APP MESA: "+a)});
})(App);
