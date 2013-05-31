(function(mesaApp){

mesaApp.View.MozoView = Backbone.Marionette.CompositeView.extend({
	template: '#mozo-view',
	className: 'mozo-column',
	
	// este no funciona ACA. no se porque. Por ese motivo esta inicializado en el metodo initialize:
	//itemView: mesaApp.View.MiniMesaView,
	
    itemViewContainer: '.mesas-list',
    
   
    initialize: function(){
    	
    	this.itemView = mesaApp.View.MiniMesaView;
    	
    	var mesas = this.model.get('mesas');
    	if (mesas) {
    		this.collection = mesas;
    	}
    }
});


})(App.mesaApp);