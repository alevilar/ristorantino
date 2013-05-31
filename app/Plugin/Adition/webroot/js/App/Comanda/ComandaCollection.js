/**
 * Collection of DetalleComanda´s
 */
App.Collection.Comanda = Backbone.Collection.extend({
        
    url: 'comandas',
        
    model: App.Model.DetalleComanda,
    
    mesa_id: null,
    
    observacion: ''
    
     
});
