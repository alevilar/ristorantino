    
R$.Router = Backbone.Router.extend({

    routes: {
        "": "root",
        "listado-mesas": 'listadoMesas',
        "mesa-view": "mesaView"
    },
        
    root: function(){
    },
     
    listadoMesas: function(){
    },

    mesaView: function($mozo) {
    }

});
