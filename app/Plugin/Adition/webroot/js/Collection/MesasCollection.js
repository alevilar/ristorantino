(function( window, undefined ) {

    var MesasCollection = Backbone.Collection.extend({
        
        url: 'mesas',
        
        model: R$.MesaModel,
        
        parse: function(a){
            return a.mesas;
        },
        
        
        comparator: function(a){
            return -a.id;
        },
        
        // Filter down the list of all todo items that are finished.
        deMozo: function(mozo_id) {
          return this.where({mozo_id: mozo_id});
        }
    
    });

    R$.mesasCollection = new MesasCollection();
   
})(window);

