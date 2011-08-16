Risto.Adition.detalleComanda = function(jsonData) {
    
    this.DetalleSabor = ko.observableArray([]);
    
    return this.initialize(jsonData);
}


Risto.Adition.detalleComanda.prototype = {
    Producto: ko.observable(),
    DetalleSabor: ko.observableArray(), // array de Sabores

    // cant de este producto seleccionado
    cant: ko.observable(0),
    cant_eliminada: ko.observable(0),
    es_entrada: ko.observable( 0 ),
    observacion: ko.observable(''),
    modificada: ko.observable(false),
    
    realCant: function(){
        return this.cant() - this.cant_eliminada();
    },
    
    initialize: function(jsonData){
        this.Producto = ko.observable();
        this.cant = ko.observable(0);
        this.cant_eliminada = ko.observable(0);
        this.es_entrada = ko.observable.call( false );
        this.observacion = ko.observable('');
        this.modificada = ko.observable(false);

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
        this.modificada(true);
    },
    
    
    deseleccionar: function(){
        if (this.realCant() > 0 ) {
            if ( window.confirm('Seguro que desea quitar 1 '+this.Producto().name) ) {
                this.cant_eliminada( this.cant_eliminada()+1 );
                this.modificada(true);
            }
        }
    },
    
    /**
     * Modifica el estado de el objeto indicando si es entrada o no
     * modifica this.es_entrada
     */
    toggleEsEntrada: function(){
        this.es_entrada( !this.es_entrada() );
    },
    
    esEntrada: function(){
        // no se por que pero hay veces en que viene el boolean como si fuera un character asique deboi
        // hacer esta verificacion
        if ( this.es_entrada() && (this.es_entrada() === true || this.es_entrada() === '1') ){
            console.debug("es entrada");
            return true;
        }
        return false;
    },
    
    
    addObservacion: function(e){
        this.modificada(true);
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
