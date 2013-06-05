
// Start Marionette Ristorantino App

App.mesaApp.on('start', function () {
			
					
		}
);


App.mesaApp.on('all', function(a){
	console.debug("hay "+a)}
	);


App.start();
App.contentRegion.show( App.mesaApp.currentView );