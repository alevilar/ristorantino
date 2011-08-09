
Risto.Adition.producto = function(data, categoria) {    
    return this.initialize(data, categoria);
}


Risto.Adition.producto.prototype = {
  
    Categoria: {},
    
    initialize: function(jsonData, categoria){
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        
        this.Categoria = categoria;
        return this;
    },
    
    seleccionar: function(){
        var event =  $.Event(MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        event.producto = this; 
        $(document).trigger(event);
    }
}
