(function(){

    R$.Router = Backbone.Router.extend({

        routes: {
            "": "root",
            "listado-mesas": "listadoMesas",
            "mesa-view": "mesaView",
            "listado-mesas?mozo=:id":  "filtraPorMozo"
        },
        
        root: function(){
            this.navigate("listado-mesas", {replace: true});
            this.filtraPorMozo(0);
        },
        
        listadoMesas: function(){
            this.filtraPorMozo(0);
        },
        
        filtraPorMozo: function(mozo_id){
            $("[href='adition#listado-mesas?mozo="+mozo_id+"']", '#listado-mozos-para-mesas').addClass('ui-btn-active');
        },
              

        mesaView: function($mozo) {
        }

    });
    R$.router = new R$.Router;
    Backbone.history.start()
})();