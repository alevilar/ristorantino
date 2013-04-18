  
    
    /**
     *
     *
     *          Mesa View -> MENU Mesa
     *
     *
     */     
    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-menu').live('pageshow',function(event, ui){ 
        
        $('form input:first', '#mesa-menu').focus().val('');
        // Form SUBMITS
        $('form','#mesa-menu').bind( 'submit', function(){
            $raeh.trigger('cambiarMenuMesa', null, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-menu').live('pagebeforehide',function(event, ui){ 
        // Form SUBMITS
         $('form','#mesa-menu').unbind( 'submit');
    });
    