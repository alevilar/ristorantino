Risto.Adition.detalleComanda = function(jsonData) {
    
    this.producto_id = ko.dependentObservable( function(){
        var prod = this.Producto();
        if ( prod ) {
            return prod.id;
        }
        return undefined;
    }, this);


    return this.initialize(jsonData);
}


Risto.Adition.detalleComanda.prototype = {
    Producto: ko.observable(),
    DetalleSabor: ko.observableArray(), // array de Sabores

    // cant de este producto seleccionado
    cant: ko.observable(0),
    cant_eliminada: ko.observable(0),
    imprimir: ko.observable(),
    es_entrada: ko.observable( 0 ),
    observacion: ko.observable(''),
    modificada: ko.observable(false),
    model: 'DetalleComanda',
    
    
    initialize: function(jsonData){
        this.DetalleSabor = ko.observableArray([]);
        this.imprimir = ko.observable(true);
        this.cant = ko.observable(0);
        this.cant_eliminada = ko.observable(0);
        this.es_entrada = ko.observable.call( false );
        this.observacion = ko.observable('');
        this.modificada = ko.observable(false);

        this.Producto = ko.observable( new Risto.Adition.producto() );
        if ( jsonData ) {
            this.Producto =  ko.observable ( new Risto.Adition.producto( jsonData.Producto ) );
            return ko.mapping.fromJS(jsonData, {} , this);
        }  
      return ko.mapping.fromJS({}, {} , this);;
    },
    
    
    /**
     * Devuelve la cantidad real del producto que se debe adicionar a la mesa.
     * O sea, la cantidad agregada menos la quitada
     */
    realCant: function(){
        return this.cant() - this.cant_eliminada();
    },
    
    
    
    /**
     *  Devuelve el nombre del producto y al final, entre parentesis los 
     *  sabores si es que tiene alguno
     *  Ej: Ensalada (tomate, lechuga, cebolla)
     *  @return String
     */
    nameConSabores: function(){
        var nom = '';
        if ( this.Producto ) {
            if ( typeof this.Producto().name == 'function'){
                nom += this.Producto().name();
            } else {
                nom += this.Producto().name;
            }
            
            if ( this.DetalleSabor().length > 0 ){
                var dsname = '';
                
                for (var ds in this.DetalleSabor()) {
                    if ( ds > 0 ) {
                        // no es el primero
                        dsname += ', ';
                    }
                    dsname += this.DetalleSabor()[ds].name;
                }
                
                if (dsname != '' ){
                    nom = nom+' ('+dsname+')';
                }                
            }
        }
        
        return nom;
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
    
    
    /**
     * Si este detalleComanda debe ser una entrada, devuelve true
     * 
     * @return Boolean
     */
    esEntrada: function(){
        // no se por que pero hay veces en que viene el boolean como si fuera un character asique deboi
        // hacer esta verificacion
        if ( this.es_entrada() && (this.es_entrada() === true || this.es_entrada() === '1') ){
            console.debug("es entrada");
            return true;
        }
        return false;
    },
    
    
    /**
     * Lee el formulario de la DOM y le mete el valor de observacion
     * Bindea el evento cuando abrio el formulario, pero cuando lo submiteo lo desbindea, 
     * para que otro lo pueda utilizar. O sea, el mismo formulario sirve para 
     * muchos detallesComandas
     */
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
    },
    
    
    /**
     * Si el DetalleComanda tiene sabores asignados, devuelve true, caso contrario false
     * @return Boolean
     */
    tieneSabores: function(){
        if ( this.DetalleSabor().length > 0) {
            return true;
        }
        return false;
    }
}

