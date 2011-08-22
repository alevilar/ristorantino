 
    

Risto.Adition = {
    koAdicionModel : {
        refreshBinding: function(){}
    },
    
    /**
     * @var Utilizada en el listado de mesas para buscar la mesa cuando se tipea el numero
     * esta variable es global, y se va llenando con cada keypress
     * por lo tanto es usual encontrar la logica de llenado de esta variable en adition.events
     */
    mesaBuscarAccessKey: '',
    mesaCurrentIndex: null
};


$(document).ready(function(){
    Risto.Adition.koAdicionModel.refreshBinding();
});
  
