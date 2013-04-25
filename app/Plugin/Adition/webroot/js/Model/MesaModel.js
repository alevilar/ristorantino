// Namespace koModel

(function(window){

    var MesaModel = Backbone.Model.extend({
        defaults : {
            estado_id: 1 // abierta
        },
        
        url : function() {
            return this.id ? 'mesas/' + this.id : 'mesas'; 
        }
    });

    R$.MesaModel = MesaModel;

})(window);
