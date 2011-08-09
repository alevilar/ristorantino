Risto.Adition.detalleComanda = function(jsonData) {
    
    return this.initialize(jsonData);
}


Risto.Adition.detalleComanda.prototype = {
    Producto: ko.observable(),

    // cant de este producto seleccionado
    cant: ko.observable(0),
    cant_eliminada: ko.observable(0),
    esEntrada: ko.observable(false),
    observacion: ko.observable(''),
    
    initialize: function(jsonData){
        this.Producto = ko.observable();
        this.cant = ko.observable(0);
        this.cant_eliminada = ko.observable(0);
        this.esEntrada = ko.observable(false);
        this.observacion = ko.observable('');

        if ( jsonData ) {
            this.Producto =  ko.observable ( new Risto.Adition.producto( jsonData.Producto ) );
            return ko.mapping.fromJS(jsonData, {} , this);
        }  
        return this;
    },
    
    
    /**
     * Dispara un evento de producto seleccionado
     */
    seleccionar: function(){
        this.cant( this.cant()+1 );
    },
    
    
    deseleccionar: function(){     
        if (this.cant() > 0 ) {
            this.cant( this.cant()-1 );
        }
    },
    
    
    setEsEntrada: function(){
        this.esEntrada(true);
    },
    
    unsetEsEntrada: function(){
        this.esEntrada(false);
    },
    
    addObservacion: function(e){
        var cntx = this;
        $('#obstext').val( this.observacion() );
        $('#form-comanda-producto-observacion').submit( function(){
            alert("lindo aa "+$('#obstext').val()  );
            cntx.observacion(  $('#obstext').val() );
            $('#form-comanda-producto-observacion').unbind();
            return false;
        });
    }
    
}