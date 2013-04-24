
    /**
     *
     *
     *          Mesa View
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $(document).on('pageshow','#mesa-view',function(event, ui) {
        $('#comanda-detalle-collapsible').trigger('create');

         // CLICKS
        $('#mesa-action-comanda').on( 'click', function(){
            Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
        });

        $('#mesa-action-cobrar').on('click',function(){
            Risto.Adition.adicionar.pagos( [] );
        });
        
        var $hrefEdit = $('#mesa-action-edit'),
            hrefToEditMesa = $hrefEdit.attr('data-href');
        if ( hrefToEditMesa ) {
//            $hrefEdit.attr('href', hrefToEditMesa + Risto.Adition.adicionar.currentMesa().id() + '.jqm');
        }


          $('#mesa-cant-comensales').on('click', function(){
              Risto.Adition.adicionar.agregarCantCubiertos();
          });


        $('#mesa-cerrar').on('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.cerrada );
        });

        $('#mesa-action-reimprimir').on('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });


        $('#mesa-borrar').on('click', function(){
            if (window.confirm('Seguro que desea borrar la mesa '+Risto.Adition.adicionar.currentMesa().numero())){
                var mesa = Risto.Adition.adicionar.currentMesa();
                mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.borrada );
            }
        });


        $('#mesa-reabrir').on('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });
        
        
        
        $(document).on('mesaseleccionada', function(e) {
            console.info("vino seleccionada");
            Risto.modelMesas.promise().done(function(){
                ko.applyBindings( Risto.koMesaView(e.currentMesa) , document.getElementById('#mesa-view'));
            });
        });

    });

    $(document).on('pagebeforehide', '#mesa-view',function(event, ui){  
        $('#mesa-action-comanda').off( 'click');
        $('#mesa-action-cobrar').off('click');
        $('#mesa-cant-comensales').off('click');
        $('#mesa-cerrar').off('click');
        $('#mesa-action-reimprimir').off('click');
        $('#mesa-borrar').off('click');
        $('#mesa-reabrir').off('click');
    });


