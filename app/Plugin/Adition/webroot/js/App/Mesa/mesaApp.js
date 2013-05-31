( function ( App ) {
	
	var mesaApp = App.module("mesaApp");
	
	// init where to store views, models and collection´s class
	mesaApp.View = {};
	mesaApp.Model = {}; 
	mesaApp.Collection = {};
	
	
	mesaApp.mozosMesas = [];
	
	mesaApp.on('start', function(){
		// load data
		mesaApp.mozosMesas = new mesaApp.Collection.Mozos;
		mesaApp.mozosMesas.fetch();
		 
		// show views
		var listadoLayout = new mesaApp.View.AppLayout;
		var myView = new mesaApp.View.MozosView({collection: mesaApp.mozosMesas});
		  
		App.mainRegion.show(listadoLayout);
		listadoLayout.content.show(myView);
		
	});
	
		
})(App);
