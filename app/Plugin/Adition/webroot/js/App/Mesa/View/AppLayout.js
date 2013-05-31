(function(mesaApp){
	mesaApp.View.AppLayout = Backbone.Marionette.Layout.extend({
		template: '#mesa-app-layout',
		
		regions: {
			header:  ".header",
			content: ".content"
		}
	});

})
(App.mesaApp);