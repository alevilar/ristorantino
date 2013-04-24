

    /**
     *
     *          OPCIONES    ----   CAJERO
     *
     */
    $('#cajero-opciones').live('pageshow',function(event, ui){
        $('#modo-k').bind('change',function(){
            Risto.IMPRIME_REMITO_PRIMERO = !Risto.IMPRIME_REMITO_PRIMERO;
            $.get(urlDomain+'/configs/toggle_remito');

        });
    });

    $('#cajero-opciones').live('pagebeforehide',function(event, ui){
         $('#modo-k').unbind('change');
    });
