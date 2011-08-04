
Risto.Adition.categoria = function(data, parent){
    var lala = this.initialize(data, parent);
   
    return lala;
}

Risto.Adition.categoria.prototype = {
    Padre: {},
    Hijos: [],
    Producto: [],
    
    
    initialize: function(jsonData, parent){
        for (var i in jsonData){
            if ( typeof this[i] == 'undefined' ) {
                this[i] = jsonData[i];
            } 
        }
        
        if (jsonData.Producto) {
            this.Producto = [];
        }
        for (var p in jsonData.Producto){
            this.Producto.push( new Risto.Adition.producto( jsonData.Producto[p], this) );
        }
        
        if (jsonData.Hijos) {
            this.Hijos = [];
        }
        for (var h in jsonData.Hijos){
            if ( jsonData.Hijos[h].id ) {
                this.Hijos.push( new Risto.Adition.categoria( jsonData.Hijos[h], this) );
            }
        }
        
        if (parent) {
            this.Padre = parent;
        }
        
        return this;
    },
    
    seleccionar: function() {
        Risto.Adition.comanda.seleccionarCategoria( this );
    }
}