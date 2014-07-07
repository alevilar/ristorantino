
App.Model.Comanda = Backbone.Model.extend({
        defaults: {
            mesa_id: null,
            detalleComandas: new App.Collection.Comanda
        }
    });
