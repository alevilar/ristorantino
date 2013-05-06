R$.Router = Backbone.Router.extend({
    routes: {
        "": "root",
        "listado-mesas": 'listadoMesas',
        "mesa-view/:mesaId": "mesaView"
    },
    
    cobradas: function(){
        alert("cobradas");
    },
        
    root: function(){
    },
     
    listadoMesas: function(){
    },

    mesaView: function(mesaId) {
        console.info("en mesa view para "+ mesaId);        
    }

});
