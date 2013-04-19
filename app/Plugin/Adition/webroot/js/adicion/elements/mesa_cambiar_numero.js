

    /**
     *
     *
     *          Mesa View -> Cambiar N° Mesa
     *
     *
     */     
    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-numero').live('pageshow',function(event, ui){ 
        $('input:first', '#form-cambiar-numero').focus().val('');
        // Form SUBMITS
        $('#form-cambiar-numero').bind( 'submit', function(){
            Risto.EventHandler.trigger('cambiarNumeroMesa', null, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-numero').live('pagebeforehide',function(event, ui){ 
        // Form SUBMITS
         $('#form-cambiar-numero').unbind( 'submit');
    });
    