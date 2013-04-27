 /**
     *
     * Logica del abrir Mesa, se activa cuando se aprieta el boton de abrir mesa
     *
     */
    (function(){
        
        var $formMesaAdd = null;
                         
                
        $(document).on( 'pageshow', '#mesa-add', function(){
                $formMesaAdd = $('#form-mesa-add');
                
                if ( Risto.cubiertosObligatorios ) {
                    $('#mesa-add-cant_comensales')[0].setAttribute('required', 'required');
                }
                
                /**
                 *
                 * Luego de apretar el submit del formulario agregar mesa....
                 */
                $formMesaAdd.on('submit', function(e){
                    e.preventDefault();

                    var miniMesa = R$.formToObject($formMesaAdd);
                    R$.mesasCollection.create( miniMesa );
                    
                    $('.ui-dialog').dialog('close');
                    
                    document.getElementById('form-mesa-add').reset(); // limpio el formulario
                    return false;
                });

        });

        $(document).on( 'pagehide', '#mesa-add', function(){
            document.getElementById('form-mesa-add').reset();
            $('#form-mesa-add').off('submit');
        });
        
    })();