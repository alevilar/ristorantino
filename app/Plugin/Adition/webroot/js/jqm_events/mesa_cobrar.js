

    /**
     *
     *          COBROS               -------    CAJERO
     *
     */
    $('#mesa-cobrar').live('pageshow',function(event, ui){
        $('#mesa-cajero-reabrir').bind('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });
        $('.mesa-reimprimir', '#mesa-cobrar').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });
    });

    $('#mesa-cobrar').live('pagebeforehide',function(event, ui){
        $('#mesa-cajero-reabrir').unbind('click');
        $('.mesa-reimprimir', '#mesa-cobrar').unbind('click');
        Risto.Adition.adicionar.pagos([]);
    });
    
    
    
    

    /**
     *
     *
     *          Page COBRAR
     *
     */
    $('#mesa-cobrar').live('pageshow', function(){

        // Al apretar el boton de cobro de pago procesa los pagos correspondientes
        $('#mesa-pagos-procesar').bind('click', function(){
            // lipieza de pagos, selecciono solo los que se les haya agregado algun valor en el input
            for (var p in Risto.Adition.adicionar.pagos() ) {
                if ( Risto.Adition.adicionar.pagos()[p] ) {
                    // agrego el pago a la mesa
                    Risto.Adition.adicionar.currentMesa().Pago.push( Risto.Adition.adicionar.pagos()[p] );
                }
            }

            // reinicio los pagos
            Risto.Adition.adicionar.pagos([]);

            // cambio el estado de la mesa para disparar el evento
            Risto.Adition.adicionar.currentMesa().setEstadoCobrada();
        });
    });

    $('#mesa-cobrar').live('pagebeforehide', function(){
        $('#mesa-pagos-procesar').unbind('click');
    });
