/*--------------------------------------------------------------------------------------------------- Risto
 *
 * Paquete Risto
 */
R$ = Risto = {
    View: {},
    Collection: {},
    Model: {},
    Router: {},
    History: {},
    
    _jqmThemeMap: {
      "1": 'c', // mesas abiertas
      "2": 'g', // mesas cerradas
      "3": 'f'  // mesas cobradas
    },
    
    modo: 'adicion', // puede ser 'cajero' o 'adicionista'
    
    domInit: function(){
        $(function(){
            R$.router = new R$.Router;
            Backbone.history.start();
            
//            $.mobile.buttonMarkup.hoverDelay = 0;
            // Prevents all anchor click handling
            //        $.mobile.linkBindingEnabled = false;

            // Disabling this will prevent jQuery Mobile from handling hash changes
            //        $.mobile.hashListeningEnabled = false;
        
            $.extend(  $.mobile , {
                backBtnText: "Volver",
                defaultPageTransition: 'slide',
                defaultDialogTransition: 'pop'
            });
            
            
            R$.mesasCollection = new R$.Collection.Mesas;
            R$.listadoMesasView = new R$.View.ListadoMesas;
            R$.currentMesaView = new R$.View.Mesa;
        });
        
    },
  
                                     
    formToObject: function($form) {
        var rta = $form.serializeArray(), 
        newObj = {}; // json modelo, para crear la mesa
        for (var r in rta ) {
            newObj[rta[r].name] = rta[r].value;
        }
        return newObj;
    },
    
    
    findProductoByname: function ( nombre ) {
        var nomRegex = new RegExp(nombre, 'i'); // i = case insensitive
        return _.filter(this.productos, function (p) {
           return  p.name.match(nomRegex) || p.abrev.match(nomRegex);
        });
    }
    
}


R$.domInit();