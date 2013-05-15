R$.Router = Backbone.Router.extend({
    routes: {
        "": "root",
        "listado-mesas": 'listadoMesas',
        "mesa-view/:mesaId": "mesaView",
        "comanda-add": "comandaAdd"
    },
    
    
    comandaAddView: null,
    
    
    comandaAdd: function() {        
       
    },
    
        
    root: function(){
    },
     
    listadoMesas: function(){
    },

    mesaView: function(mesaId) {
        console.info("en mesa view para "+ mesaId);        
    }

});
