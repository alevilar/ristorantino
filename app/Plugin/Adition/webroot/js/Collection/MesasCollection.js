(function( window, undefined ) {

    var MesasCollection = Backbone.Collection.extend({
        
        url: 'mesas',
        
        model: R$.MesaModel,
        
        comparator: 'numero'
    
    });

    R$.mesasCollection = new MesasCollection();
   
})(window);

