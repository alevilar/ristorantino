
    /**
     *
     *
     *          Mesa View -> Cambiar Mozo
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-mozo').live('pageshow',function(event, ui){    
        // Form SUBMITS
        $('#form-cambiar-mozo').bind('submit', function(e){
            e.preventDefault();
            $raeh.trigger('cambiarMozo', e, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-mozo').live('pagehide',function(event, ui){ 
        // Form SUBMITS
        $('#form-cambiar-mozo').unbind('submit');
    });


