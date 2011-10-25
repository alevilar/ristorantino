/*--------------------------------------------------------------------------------------------------- PKG:Risto.Adicion
 *
 *
 * Package Adition
 */ 
    

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
  
  
  
  
  
/********----------- EXRA FUNCTIONS ---------------------------------*******/
function mostrarMesasDeMozo( mozoId ) {
    var mesasDom = $('#mesas_container li');
    mesasDom.show();
    if ( mozoId ) {
            $('#mesas_container li[mozo!='+mozoId+']').hide();
            $('.listado-mozos-para-mesas a').removeClass('ui-btn-active');
            $('.listado-mozos-para-mesas a[data-mozo-id='+mozoId+']').addClass('ui-btn-active');
            
            // pongo a este mozo como el seleccionado en el formulario de nueva mesa
            var radio = $('#radio-mozo-id-'+mozoId);
            radio.prop('checked', true);
            radio.next().addClass('ui-btn-active');
        }
}
