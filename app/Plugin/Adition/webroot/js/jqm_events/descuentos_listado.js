
    /**
     *
     *          DESCUENTOS LISTADO
     *
     */
    $('#descuentos-jqm_descuentos').live('pageshow',function(event, ui){

        $('#mesa-eliminar-descuento').bind('click',function(){
            Risto.koModel.mesa.currentMesa().eliminarDescuento( );
            return true;
        });

    });

    $('#mesa-eliminar-descuento').live('pagebeforehide',function(event, ui){
        $('#mesa-eliminar-cliente').unbind('click');
    });
    