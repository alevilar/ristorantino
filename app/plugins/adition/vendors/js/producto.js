
Risto.Adition.producto = function(data, categoria) {    
    return this.initialize(data, categoria);
}


Risto.Adition.producto.prototype = {
  
    Categoria: {},
    // cant de este producto seleccionado
    cant: ko.observable(0),
    esEntrada: ko.observable(false),
    observacion: ko.observable(''),
    
    initialize: function(jsonData, categoria){
        for (var i in jsonData){
//            if ( typeof this[i] == 'undefined' ) {
                this[i] = jsonData[i];
//            } 
        }
        
        this.cant = ko.observable(0);
        this.esEntrada = ko.observable(false);
        this.observacion = ko.observable('');
        this.Categoria = categoria;
        return this;
    },
    
    seleccionar: function(){
        this.cant( this.cant()+1 );
        Risto.Adition.menu.seleccionarProducto(this);
    },
    
    deseleccionar: function(){     
        if (this.cant() > 0 ) {
            this.cant(this.cant()-1);
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
            cntx.observacion( $('#obstext').val() );
            $('#form-comanda-producto-observacion').unbind();
            return false;
        });
        
//        $.mobile.changePage( $("#obss"), {transition: "slideup"} );	
    }
    
}
