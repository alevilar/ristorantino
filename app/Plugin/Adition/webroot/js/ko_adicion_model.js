/*--------------------------------------------------------------------------------------------------- KO MODEL
 *
 *
 * Clase Vista de knockout.js depende de Risto.Adition.adicionar y Risto.Adition.menu
 */



/**
 *
 *
 *  KO Model
 *  
 *  Aca van todos los bindings que se realizaran en la vista
 *
 *  tambien el mapeo de datos entre arrays que vienen del servidor
 *
 *
 */
Risto.Adition.koAdicionModel = {
    
    adn     : ko.observable( Risto.Adition.adicionar ),
    menu    : ko.observable( Risto.Adition.menu ),
    
    tieneCurrentMesa: function(){
        if ( typeof this.adn().currentMesa() == 'object')  {
            return true;
        } else {
            return false;
        }
    },
    
    refreshBinding: function(){
        ko.applyBindings( Risto.Adition.koAdicionModel );
    }
}
