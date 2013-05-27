/**
 * Collection of DetalleComanda´s
 */
R$.Collection.Comanda = Backbone.Collection.extend({
        
    url: 'comandas',
        
    model: R$.Model.DetalleComanda,
    
    mesa_id: null,
    
    observacion: ''
    
     
});
