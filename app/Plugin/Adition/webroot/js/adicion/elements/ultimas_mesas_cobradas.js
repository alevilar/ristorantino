
    /**
     *
     *  LISTADO DE MESAS COBRADAS
     *  
     */
    $('#Ultimas_mesas_cobradas').live('pageshow',function(event, ui){  
        $('#Ultimas_mesas_cobradas ul').bind('click', function(e,t) {       
            var jsoncito = JSON.parse( $(e.target).attr('data-mesa') );
            var mesa = Risto.Adition.adicionar.crearNuevaMesa( jsoncito );
            Risto.Adition.adicionar.setCurrentMesa(mesa);
        });
    });
    
    $('#Ultimas_mesas_cobradas').live('pagebeforehide',function(event, ui){  
        $('#Ultimas_mesas_cobradas ul').unbind('click');
    });


