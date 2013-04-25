
new R$.ListadoMesasView;

$(document).on('pageshow', '#listado-mesas',function(event, ui){    
    
    R$.mesasCollection.fetch();
    setInterval(function(){
          R$.mesasCollection.fetch();
    }, 5000);
    
    
});


$(document).on('pagebeforehide','#listado-mesas',function(event, ui){
//    $('#mesa-abrir-mesa-btn').unbind('click');
//    $('#listado-mozos-para-mesas').unbind('click');
//        
//    // al hacer click n un mozo del menu bar
//    // se muestran solo lasmesas de ese mozo
//    var $listadoMozos = $('#listado-mozos-para-mesas');
//    $listadoMozos.undelegate('a', 'click');
});
    
    