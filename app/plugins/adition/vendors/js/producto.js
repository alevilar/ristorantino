/*--------------------------------------------------------------------------------------------------- Risto.Adicion.producto
 *
 *
 * Clase Producto
 */
Risto.Adition.producto = function(data, categoria) {    
    return this.initialize(data, categoria);
}


Risto.Adition.producto.prototype = {
    Categoria: {},
    
    initialize: function(jsonData, categoria){
        this.id = ko.observable( 0 );
        for (var i in jsonData){
                this[i] = jsonData[i];
        }
        
        this.Categoria = categoria;
        return this;
//        return ko.mapping.fromJS(jsonData, {} , this);;
    },
    
        
    seleccionar: function(){
        var event =  $.Event(MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        event.producto = this; 
        $(document).trigger(event);
    },
    
    tieneSabores: function(){
        if ( this.Categoria.Sabor.length > 0 ){
            return true;
        }
        return false;
    }
}
