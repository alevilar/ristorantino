/*--------------------------------------------------------------------------------------------------- Risto.Adicion.cliente
 *
 *
 * Clase Cliente
 */

Risto.Adition.cliente = function(jsonMap){   
    
    return this.initialize(jsonMap);
}

Risto.Adition.cliente.prototype = {
    Descuento: ko.observable(null),
    porcentaje: ko.observable( undefined ),
    
    
    /**
     * @return Boolean
     * Devuelve true o false dependiendo si el cliente tiene o no un descuento aplicado
     */
    tieneDescuento: function() {
        var porcentaje = undefined;
        if (this.descuento_id() && this.Descuento() && this.Descuento().porcentaje && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() );
        }
        return porcentaje;
    },
    
    
    /**
     * @return String
     * Devuelve el porcentaje que tiene el cliente con el "%" Concatenado.
     * Ej: "10%"
     */
    getDescuentoText : function(){
        var porcentaje = 0;
        if (this.Descuento() && this.Descuento().porcentaje()) {
            porcentaje = parseInt( this.Descuento().porcentaje() )+ '%';
        }
        return porcentaje;
    },
    
    getTipoFactura: function(){
        var tipo = 'R';
        if ( this.tipofactura() && this.tipofactura() != '0' ) {
            tipo = this.tipofactura();
        }
        return tipo;
    },
    
    /**
     * @param Char val por ejemplo puede ser "A" o "B", tambien se pueden ingresar en minusculas y da igual
     * 
     * Es para determinar si el tipo de factura de este cliente es la consultada
     * 
     */
    esTipoFactura: function( val ){        
        var ret = false
        if ( this.tipofactura().toLowerCase() == val.toLowerCase() ) {
            ret = true;
        }
        return ret;
    },
    
    initialize: function( jsonMap ){
        if ( !jsonMap ) {
            return null;
        }
        if (jsonMap.hasOwnProperty( 'Cliente' ) ) {
            jsonMap = cliente.Cliente;
        }
        
        this.Descuento  = ko.observable( null );
        this.porcentaje = ko.observable( undefined );
        
        if (jsonMap.Descuento && jsonMap.Descuento.id) {
            this.Descuento( new Risto.Adition.descuento(jsonMap.Descuento) );
        }
        delete jsonMap.Descuento;
        
        ko.mapping.fromJS(jsonMap, {}, this);
        return this;
    }
}