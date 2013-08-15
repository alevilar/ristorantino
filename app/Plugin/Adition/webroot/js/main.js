
// Start Marionette Ristorantino App
(function(App, mesaApp, comandaApp){
	
	// run on DOM Loaded
        App.start();
	
	
	
	mesaApp.on('all', function(a){
		console.log("mesaApp: %o", a);
	});
//	
//	comandaApp.on('all', function(a){
//		console.log("comandaApp: %o", a);
//	});
//	
	App.on('all', function(a) {
		console.log("APP: %o", a);
	});
	
	mesaApp.on('comanda:add', function( mesa ){
		App.router.navigate("comanda-add/" + mesa.cid, {trigger: true, popo:"popo"}, {lala:"pepe"});
	})
	
	
	
})(App, App.module('mesaApp'), App.module('comandaApp') );
