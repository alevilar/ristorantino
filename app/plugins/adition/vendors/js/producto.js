
Risto.Adition.producto = function(data) {    
    return this.initialize(data);
}


Risto.Adition.producto.prototype = {
    id : 0,
    
    // cant de este producto seleccionado
    cant: 0,
    
    initialize: function(jsonData){
        this.cant = ko.observable(0);
        
        return ko.mapping.fromJS(jsonData, null, this);
    },
    
    seleccionar: function(){
        this.cant(this.cant()+1);
        Risto.Adition.comanda.seleccionarProducto(this);
    },
    
    deseleccionar: function(){
        if (this.cant() > 0 ) {
            this.cant(this.cant()-1);
        }
    }
}
