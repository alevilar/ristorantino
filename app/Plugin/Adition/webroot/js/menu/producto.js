/*--------------------------------------------------------------------------------------------------- Risto.Adicion.producto
 *
 *
 * Clase Producto
 */
Risto.menu.producto = function(data, categoria) {    
    return this.initialize(data, categoria);
}


Risto.menu.producto.prototype = {
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
    
        
    seleccionar: function(e){       
        var event =  $.Event(MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        event.producto = this; 
        var container = e?e:document;
        $(container).trigger(event);
    },
    
    tieneSabores: function(){
        if ( this.Categoria.Sabor.length > 0 ){
            return true;
        }
        return false;
    }
}
