Risto.Adition.cliente = function(jsonMap){    
    return this.initialize(jsonMap);
}

Risto.Adition.cliente.prototype = {
    Descuento: ko.observable(),
    
    initialize: function(jsonMap){
        this.Descuento = ko.observable( null );
        
        if (jsonMap.Descuento && jsonMap.Descuento.id) {
            this.Descuento( new Risto.Adition.descuento(jsonMap.Descuento) );
        }
        delete jsonMap.Descuento;
        
        ko.mapping.fromJS(jsonMap, {}, this);
        return this;
    }
}