
R$.Model.Comanda = Backbone.Model.extend({
        defaults: {
            mesa_id: null,
            detalleComandas: new R$.Collection.Comanda
        }
    });
