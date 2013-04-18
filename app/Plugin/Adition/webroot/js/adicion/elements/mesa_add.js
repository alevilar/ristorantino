 /**
     *
     * Logica del abrir Mesa, se activa cuando se aprieta el boton de abrir mesa
     *
     */
    (function(){
        
        var $formMesaAdd = null;
         
         
        /**
         * Desbindea los eventos para liberar memoria
         *
         */
        function unbindALl() {
                     $('#add-mesa-paso3-submit, #add-mesa-paso2-volver').unbind('click');
                     $('#add-mesa-paso1 LABEL, #add-mesa-paso3-volver').unbind('click');
                     $('#add-mesa-paso2-submit').unbind('click');
                     $formMesaAdd.unbind('submit');
        }
                
                
        $('#mesa-add').live( 'pageshow', function(){
                $formMesaAdd = $('#form-mesa-add');
                $p3 = $('#add-mesa-paso3');
                $p2 = $( '#add-mesa-paso2');
                $p1 = $( '#add-mesa-paso1');

                /**
                 *
                 * Luego de apretar el submit del formulario agregar mesa....
                 */
                function agregarNuevaMesa(e){
                    
                    unbindALl();
                    e.preventDefault();

                    var rta = $formMesaAdd.serializeArray(), 
                        miniMesa = {}, // json modelo, para crear la mesa
                        mesa; // nueva mesa creada

                    for (var r in rta ) {
                        if (rta[r].name == 'numero' && !rta[r].value){
                            alert("Debe completar numero de mesa");
                            return false;
                        }

                        if (rta[r].name == 'cant_comensales' && !rta[r].value && Risto.Adition.cubiertosObligatorios){
                            alert("Debe indicar la cantidad de cubiertos");
                            return false;
                        }
                        miniMesa[rta[r].name] = rta[r].value;
                    }

                    mesa = Risto.Adition.adicionar.abrirNuevaMesa( miniMesa );
                    Risto.Adition.EventHandler.mesaSeleccionada( {"mesa": mesa} );
                    Risto.Adition.adicionar.setCurrentMesa( mesa );
                    $.mobile.changePage('#mesa-view');
                    document.getElementById('form-mesa-add').reset(); // limpio el formulario

                    return false;
                }
    
                // Eventos para abrir una mesa
                $('#mesa-abrir-mesa-btn').bind('click', function(){
                       $p2.hide();
                       $p3.hide();
                       $p1.show();
                });

                // Ir al paso 1
                $('#add-mesa-paso3-submit, #add-mesa-paso2-volver').bind('click', function(){
                  $p3.hide();
                  $p2.hide();
                  $p1.show();
                });

                // Ir al paso 2
                $('#add-mesa-paso1 LABEL, #add-mesa-paso3-volver').bind('click', function(){
                   $p1.hide();
                   $p3.hide();
                   $p2.show();           
                   $('#add-mesa-paso2').find( 'input').focus();
                });

                // Ir al paso 3
                $('#add-mesa-paso2-submit').bind('click', function(){
                   $p1.hide();
                   $p2.hide();
                   $p3.show();   
                   $('#add-mesa-paso3').find( 'input').focus();
                });

                $('#form-mesa-add').bind('submit', agregarNuevaMesa);

        });

        $('#mesa-add').live( 'pagehide', function(){
            unbindALl();
            document.getElementById('form-mesa-add').reset();
        });


        
        
    })();
     
    