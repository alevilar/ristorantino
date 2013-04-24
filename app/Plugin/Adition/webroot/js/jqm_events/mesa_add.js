 /**
     *
     * Logica del abrir Mesa, se activa cuando se aprieta el boton de abrir mesa
     *
     */
    (function(){
        
        var $formMesaAdd = null;
                         
                
        $(document).on( 'pageshow', '#mesa-add', function(){
                $formMesaAdd = $('#form-mesa-add');
                
                /**
                 *
                 * Luego de apretar el submit del formulario agregar mesa....
                 */
                function agregarNuevaMesa(e){
                    e.preventDefault();

                    var rta = $formMesaAdd.serializeArray(), 
                        miniMesa = {}, // json modelo, para crear la mesa
                        mesa; // nueva mesa creada
                    for (var r in rta ) {
                        if (rta[r].name == 'numero' && !rta[r].value){
                            alert("Debe completar numero de mesa");
                            return false;
                        }

                        if (rta[r].name == 'cant_comensales' && !rta[r].value && Risto.cubiertosObligatorios){
                            alert("Debe indicar la cantidad de cubiertos");
                            return false;
                        }
                        miniMesa[rta[r].name] = rta[r].value;
                    }
                    R$.mesasCollection.push( miniMesa );
                    $.mobile.changePage('#mesa-view');
                    document.getElementById('form-mesa-add').reset(); // limpio el formulario
                    return false;
                }

                $formMesaAdd.on('submit', agregarNuevaMesa);

        });

        $(document).on( 'pagehide', '#mesa-add', function(){
            document.getElementById('form-mesa-add').reset();
        });


        
        
    })();
     
    