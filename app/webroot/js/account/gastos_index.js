jQuery( function($){
    
    $('input[name=gasto_seleccionado]').change(function (e) {
        var gastoId = e.target.value;
        $('#gasto-'+gastoId).toggleClass('ui-btn-active');
        return false;
    });
    
}(jQuery) );
