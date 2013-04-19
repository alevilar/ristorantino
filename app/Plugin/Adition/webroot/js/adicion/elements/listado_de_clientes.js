
    /**
     *
     *          CLIENTES LISTADO
     *
     */
    $('#listado_de_clientes').live('pageshow',function(event, ui){

        $('input', '#contenedor-listado-clientes-factura-a').bind('keypress', function(){
                    $('.factura-a-cliente-add').show();
         });

        $('#mesa-eliminar-cliente').bind('click',function(){
            Risto.koModel.mesa.currentMesa().setCliente( null );
            return true;
        });

    });

    $('#listado_de_clientes').live('pagebeforehide',function(event, ui){

        $('#mesa-eliminar-cliente').unbind('click');
        $('input', '#contenedor-listado-clientes-factura-a').unbind('keypress');
    });
    