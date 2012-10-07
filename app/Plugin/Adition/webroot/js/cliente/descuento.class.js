/*--------------------------------------------------------------------------------------------------- Risto.Adicion.descuento
 *
 *
 * Clase Descuento
 */

Risto.Adition.descuento = function(jsonData){
    this.descuento = ko.observable( 0 );
    return this.initialize(jsonData);
}


Risto.Adition.descuento.prototype = {
    initialize: function(jsonData){
        return ko.mapping.fromJS(jsonData, {}, this);       
    }
}

