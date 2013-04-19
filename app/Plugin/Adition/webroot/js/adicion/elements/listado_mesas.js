
$('#listado-mesas').live('pagecreate',function(event, ui){    
    var $listadoMozos = $('#listado-mozos-para-mesas');

//    ko.applyBindings(Risto.koModel.listado_mesas, document.getElementById('#listado-mesas'))
    $listadoMozos.removeClass('ui-grid-a');

    // al hacer click n un mozo del menu bar
    // se muestran solo lasmesas de ese mozo
    $listadoMozos.delegate('a', 'click', function(e) {
        Risto.EventHandler.trigger('mostrarMesasDeMozo', e.currentTarget);
        return false;        
    });
   
});


$('#listado-mesas').live('pagebeforehide',function(event, ui){
//    $('#mesa-abrir-mesa-btn').unbind('click');
//    $('#listado-mozos-para-mesas').unbind('click');
//        
//    // al hacer click n un mozo del menu bar
//    // se muestran solo lasmesas de ese mozo
//    var $listadoMozos = $('#listado-mozos-para-mesas');
//    $listadoMozos.undelegate('a', 'click');
});
    
    