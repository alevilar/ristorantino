(function(mesaApp, MesaView){

mesaApp.View.MozoView = Backbone.Marionette.CompositeView.extend({
	
	template: '#mozo-view',
	className: 'mozo-column',
	
	// este no funciona ACA. no se porque. Por ese motivo esta inicializado en el metodo initialize:
	itemView: MesaView,
	
    itemViewContainer: '.mesas-list',
  
    triggers: {
    	"click button.mozo": 'mozo:selected'
  	},
   
    initialize: function(e){
    	var mesas = this.model.get('mesas');
    	if (mesas) {
    		this.collection = mesas;
    	}
    	
    	// sets width porporcionaly
    	var width = 100/App.mesaApp.mozosMesas.length;
    	this.el.style.width = width+"%";
    }
});


})(App.mesaApp, App.mesaApp.View.MesaView);