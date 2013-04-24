(function(window){
    
    var 
    // Define a local copy of jQuery
    koMesaView = function( selector, context ) {
        // The jQuery object is actually just the init constructor 'enhanced'
        return new Risto.koMesaView.fn.init( mesaJS );
    }
    
    koMesaView.fn = koMesaView.prototype = {
        
        init: function(mesaJS){
            for(key in mesaJS){
                this.prototype[key] = mesaJS[key];
            }
            return this;
        }
    }

    
    
    
    if ( typeof window === "object" && typeof window.document === "object" ) {
        window.Risto.koMesaView =  koMesaView;
    }

    // Give the init function the jQuery prototype for later instantiation
    Risto.koMesaView.fn.init.prototype = Risto.koMesaView.fn;   
})(window);
