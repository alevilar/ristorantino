Risto.Adition.comanda = function(jsonData){
    this.DetalleComanda = ko.observableArray([]);
    return this.initialize( jsonData );
}


Risto.Adition.comanda.prototype = {
    // Array de DetalleComanda, cada detalleComanda es 1 producto
    DetalleComanda : ko.observableArray([]),
    created: ko.observable(),
    model: 'Comanda',
    imprimir: ko.observable(),
    id: ko.observable(),
    observacion: ko.observable(),
    
    initialize: function(jsonData) {
        this.id = ko.observable();
        this.imprimir = ko.observable( true );
        this.observacion = ko.observable(  );
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
           
        } else {
            jsonData = {};
            mapOps = {};
        }
        ko.mapping.fromJS(jsonData, mapOps, this);
        Risto.modelizar(this);
        return this;
    },
    
    productsStringListing: function(){
        var name = '';        
        for (var dc in this.DetalleComanda() ){
            if (dc > 0){
                name += ', ';
            }
            name += this.DetalleComanda()[dc].realCant()+' '+this.DetalleComanda()[dc].Producto().name;
        }
        return name;
    },
    
    
    handleAjaxSuccess: function(data){
//        ko.mapping.updateFromJS(this, data.Comanda)
        this.id(data.Comanda.Comanda.id);
        this.created(data.Comanda.Comanda.created);
    },
    
     timeCreated: function(){
         if (!this.timeCreated) {
            Risto.modelizar(this);
    }
        return this.timeCreated();
     }
    
}