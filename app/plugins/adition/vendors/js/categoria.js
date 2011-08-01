
Risto.Adition.categoria = function(data){
    return this.initialize(data)
}

Risto.Adition.categoria.prototype = {
    id : 0,
    
    initialize: function(jsonData){
        var ops = {
            'Hijos': {
                key: function(data) {
                    return ko.utils.unwrapObservable(data.id);
                },
                create: function(options) {
                    return new Risto.Adition.categoria(options.data);
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
        
//        this.prototype = jsonData.Categoria;

        for (var i in jsonData.Categoria){
            this[i] = jsonData.Categoria[i];
        }
        return ko.mapping.fromJS(jsonData, ops, this);
    }
}