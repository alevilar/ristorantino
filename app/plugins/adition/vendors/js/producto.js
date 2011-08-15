
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
        if ( this.Categoria.Sabor.length == 0 ) {
            var event =  $.Event(MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
            event.producto = this; 
            $(document).trigger(event);
        } else {
            Risto.Adition.adicionar.currentMesa().currentComanda().currentSabores( this.Categoria.Sabor );
        }
    }
}
