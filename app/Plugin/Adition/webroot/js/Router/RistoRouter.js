R$.Router = Backbone.Router.extend({
    routes: {
        "": "root",
        "listado-mesas": 'listadoMesas',
        "mesa-view/:mesaId": "mesaView",
        "comanda-add": "comandaAdd"
    },
    
    
    comandaAddView: null,
    
    
    comandaAdd: function() {        
        if ( !R$.comandaAddView ) {
            // if not exist, create new instance    
            R$.comandaAddView = new R$.View.ComandaAddView({model: R$.currentMesaView.model});
        } else {
            R$.comandaAddView.setModel(R$.currentMesaView.model);
        }
    },
    
        
    root: function(){
    },
     
    listadoMesas: function(){
    },

    mesaView: function(mesaId) {
        console.info("en mesa view para "+ mesaId);        
    }

});
