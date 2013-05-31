(function(mesaApp){
	mesaApp.View.ListadoMesasView = Backbone.Marionette.CollectionView.extend({
	
	    el: $("#listado-mesas"),
	    
	    itemView: mesaApp.View.ItemListadoMesas,
	    
	    events: {
	        "click .btn-mozo": "abrirMesaDeMozo"
	    },

	    
	    add: function( mesa ) {
	        new App.View.ItemListadoMesas( {
	            model: mesa
	        } );
	        this.render();
	        return this;
	    },
	    
	    
	    
	    abrirMesaDeMozo: function(e){
	        e.preventDefault();
	        var hash = e.currentTarget.hash,
	        hsi = hash.indexOf('='),
	        mozoId = hash.substr(hsi+1),
	        mozo = _.find(App.mozos, function(m){
	            return m.id == mozoId
	            });
	                
	        $.mobile.changePage( "#mesa-add"); 
	        $('form input[name="mozo_id"]', "#mesa-add").val(mozoId);
	        $('.ui-title','#mesa-add').text("Abrir Mesa de Mozo "+mozo.numero);
	    }
	
	});

})(App.mesaApp);  
