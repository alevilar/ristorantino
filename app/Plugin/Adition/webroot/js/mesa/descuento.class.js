/*--------------------------------------------------------------------------------------------------- Risto.Adicion.descuento
 *
 *
 * Clase Descuento
 */
if (!Risto.mesa){
    Risto.mesa = {}
}

Risto.mesa.descuento = function(jsonData){
    this.descuento = ko.observable( 0 );
    return this.initialize(jsonData);
}


Risto.mesa.descuento.prototype = {
    initialize: function(jsonData){
        return ko.mapping.fromJS(jsonData, {}, this);       
    }
}

