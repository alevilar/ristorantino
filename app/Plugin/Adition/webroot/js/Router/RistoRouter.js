(function(){
    var title = "COQUS, El Ristorantino Mágico";
    
    R$.Router = Backbone.Router.extend({

        routes: {
            "": "root",
            "listado-mesas": 'listadoMesas',
            "mesa-view": "mesaView"
        },
        
        root: function(){
            this.navigate("listado-mesas", {
                replace: true
            });
            document.title = title; 
        },
     
        listadoMesas: function(){
            document.title = title;   
        },

        mesaView: function($mozo) {
        }

    });
    R$.router = new R$.Router;
    Backbone.history.start()
})();