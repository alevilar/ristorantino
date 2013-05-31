(function(mesaApp){
	mesaApp.Collection.Mesas = Backbone.Collection.extend({
	        
	    url: 'mesas',
	        
	    model: mesaApp.Model.Mesa,
	        
	    parse: function(a){
	        return a.mesas;
	    },
	        
	    
	    comparator: function(a){
	        return -a.id;
	    },
	        
	    // Filter down the list of all todo items that are finished.
	    deMozo: function(mozo_id) {
	        return this.where({
	            mozo_id: mozo_id
	        });
	    },
	    
	    
	    findMesaById: function(mesaId){
	        return this.find(function(m){
	            return m.id == mesaId;
	        })
	    }
	    
	});
	
	   
})(App.mesaApp);
