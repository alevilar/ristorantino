
Risto.Adition.categoria = function(data, parent){
    return this.initialize(data, parent)
}

Risto.Adition.categoria.prototype = {
    id : 0,
    Hijos: [],
    Producto: [], 
    
    initialize: function(jsonData, parent){
              
        for (var p in jsonData.Producto){
            this.Producto.push( new Risto.Adition.producto(jsonData.Producto[p], this) );
        }
        
        for (var h in jsonData.Hijos){
            this.Hijos.push( new Risto.Adition.categoria(jsonData.Hijos[h], this) );
        }
        
        for (var i in jsonData.Categoria){
            this[i] = jsonData.Categoria[i];            
        }
        
        if (parent) {
            this.Padre = parent;
        }
        
        
        return ko.mapping.fromJS(jsonData, null, this);
    },
    
    seleccionar: function() {
        Risto.Adition.comanda.seleccionarCategoria( this );
    }
}