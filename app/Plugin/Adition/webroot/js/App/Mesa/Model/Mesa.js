(function(mesaApp){
	mesaApp.Model.Mesa = Backbone.RelationalModel.extend({
	        defaults: {
	                estado_id: 1,
	                cliente_abr: '"B"',
	                time_abrio_abr: "-",
	                time_cerro_abr: "-"
	        }
	    });
	
})(App.mesaApp);
