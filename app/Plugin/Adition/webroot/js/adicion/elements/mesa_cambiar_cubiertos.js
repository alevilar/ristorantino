
    
    /**
     *
     *
     *          Mesa View -> Cambiar Cant Cubiertos
     *
     *
     */     
    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-cubiertos').live('pageshow',function(event, ui){ 
        $('input:first', '#form-cambiar-cubiertos').focus().val('');
        // Form SUBMITS
        $('#form-cambiar-cubiertos').bind( 'submit', function(){
            $raeh.trigger('cambiarCantComensales', null, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-cubiertos').live('pagebeforehide',function(event, ui){ 
        // Form SUBMITS
         $('#form-cambiar-cubiertos').unbind( 'submit');
    });
    