/*--------------------------------------------------------------------------------------------------- Risto.Adicion.descuento
 *
 *
 * Clase Descuento
 */

Risto.Adition.descuento = function(jsonData){
    return this.initialize(jsonData);
}


Risto.Adition.descuento.prototype = {
    initialize: function(jsonData){
        return ko.mapping.fromJS(jsonData, {}, this);       
    }
}

