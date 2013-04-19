/*--------------------------------------------------------------------------------------------------- Risto.Adicion.pago
 *
 *
 * Clase Pago
 */
Risto.mesa.pago = function(jsonOb){
    
    return this.initialize(jsonOb);
}


Risto.mesa.pago.prototype = {
    model       : 'Pago',
    TipoDePago  : function( ) {},
    valor       : function( ) {},
    mesa_id     : function( ) {},
    tipo_de_pago_id: undefined,
    
    initialize: function(jsonOb){
        
        this.valor = ko.observable();
        this.mesa_id = Risto.koModel.mesa.currentMesa().id();
        
        this.TipoDePago = ko.observable(null);
        if (jsonOb) {
            this.TipoDePago(jsonOb);
            
            this.tipo_de_pago_id = this.TipoDePago().id;
        }
        
        Risto.KoModel.mesa.pagos.push(this);
        
        // hacer auto focus al ultimo ingresado
        var inputs = $('.pagos_creados').find('[name="valor"]');
        inputs[inputs.length-1].focus();
    },
    
    image: function(){
        if (this.TipoDePago() && this.TipoDePago().image_url) {
            return urlDomain + 'img/' + this.TipoDePago().image_url;
        }
        return '';
    }
}