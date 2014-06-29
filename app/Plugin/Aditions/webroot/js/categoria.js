/*--------------------------------------------------------------------------------------------------- Risto.Adicion.categoria
 *
 *
 * Clase Categoria
 */
Risto.Adition.categoria = function(data, parent){
    this.initialize(data, parent);
    return this;
}

Risto.Adition.categoria.prototype = {
    Padre: {},
    Hijos: [],
    Producto: [],
    Sabor: [],
    image_url: '',
    
    
    initialize: function(jsonData, parent){

        for (var i in jsonData){
            if ( typeof this[i] == 'undefined' ) {
                this[i] = jsonData[i];
            } 
        }
        
        this.image_url = jsonData.image_url;
        
        if (jsonData.Sabor) {
            this.Sabor = [];
        }
        for (var p in jsonData.Sabor){
            this.Sabor.push( new Risto.Adition.sabor( jsonData.Sabor[p], this) );
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
        Risto.Adition.menu.seleccionarCategoria( this );
    }
}