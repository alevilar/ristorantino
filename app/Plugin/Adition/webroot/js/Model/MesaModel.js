// Namespace koModel

(function(window){

    var listadoMesasView;
    
    var MesaModel = Backbone.Model.extend({
        defaults : {
            numero : 0,
            mozo_id : 0,
            Cliente : {
                fipofactura: 'B'
            },
            Descuento:{},
            Mozo: {
                numero: 0
            },
            estado_id: 1, // abierta
            created: '-'
        },
 
        initialize: function() {
            listadoMesasView = new R$.ListadoMesasView({model: this});
        },
 
        url : function() {
            // Important! It's got to know where to send its REST calls. 
            // In this case, POST to '/donuts' and PUT to '/donuts/:id'
            return this.id ? '/mesas/' + this.id : '/mesas'; 
        } 
    });

    R$.MesaModel = MesaModel;


})(window);
