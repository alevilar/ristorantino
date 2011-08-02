
Risto.Adition.categoria = function(data, parent){
    return this.initialize(data, parent)
}

Risto.Adition.categoria.prototype = {
    id : 0,
    
    initialize: function(jsonData, parent){
        var ops = {
            'Hijos': {
                key: function(data) {
                    return ko.utils.unwrapObservable(data.id);
                },
                create: function(options) {
                    return new Risto.Adition.categoria(options.data, options.parent);
                }
            },
            'Producto': {
                key: function(data) {
                    return ko.utils.unwrapObservable(data.id);
                },
                create: function(options) {
                    return new Risto.Adition.producto(options.data);
                }
            }
        }
        
        for (var i in jsonData.Categoria){
            this[i] = jsonData.Categoria[i];            
        }
        console.info(this);
        console.debug(parent);
        if (parent) {
            this.Padre = parent;
        }
        ko.mapping.fromJS(jsonData, ops, this);
        
        return this;
    },
    
    seleccionar: function() {
        Risto.Adition.comanda.seleccionarCategoria( this );
    }
}