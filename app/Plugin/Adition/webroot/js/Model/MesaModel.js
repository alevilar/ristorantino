// Namespace koModel

(function(window){

    var listadoMesasView,
        mesaView;
    
    var MesaModel = Backbone.Model.extend({
        defaults : {
            estado_id: 1 // abierta
        },
 
        initialize: function() {
            listadoMesasView = new R$.ListadoMesasView({model: this});
        },
 
        
        url : function() {
            // Important! It's got to know where to send its REST calls. 
            // In this case, POST to '/donuts' and PUT to '/donuts/:id'
            return this.id ? 'mesas/' + this.id : 'mesas'; 
        } 
    });

    R$.MesaModel = MesaModel;


})(window);
