(function(mesaApp){

mesaApp.View.MesaFormView = Backbone.Marionette.ItemView.extend({
	
	template: '#mesa-add',
	
  	triggers: {
  		"submit form": 'submit'
  	},
  	
  	onRender: function ()
  	{
  		this.$('input').first().focus();
  	}
});


})(App.mesaApp);