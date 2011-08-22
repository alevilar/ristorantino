Risto.Adition.comanda = function(jsonData){
    this.DetalleComanda = ko.observableArray([]);
    return this.initialize( jsonData );
}


Risto.Adition.comanda.prototype = {
    // Array de DetalleComanda, cada detalleComanda es 1 producto
    DetalleComanda : ko.observableArray([]),
    created: ko.observable(),
    model: 'Comanda',
    
    initialize: function(jsonData) {
        this.created = ko.observable();
        
        if ( jsonData ) {
            // si aun no fue mappeado
            var mapOps = {
                'DetalleComanda': {
                    create: function(ops) {
                        return new Risto.Adition.detalleComanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable(data.id);
                    }
                }
            }
            return ko.mapping.fromJS(jsonData, mapOps, this);
        }
        return this;
    },
    
    
    timeCreated: function(){
        var d;
        
        if (this.created() ) {
            d = new Date( mysqlTimeStampToDate(this.created() ) );      
        } else {
            d = new Date(); 
        }
        
        return d.toLocaleTimeString();
    }
//    ,
//    
//    handleAjaxSuccess: function(){
//        return true;
//    }
    
}