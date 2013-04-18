/**
*
*
*          COMANDA ADD
*
*/
(function(){
    
    $('#comanda-add-product-obss').live('pageshow',function(event, ui){    
        $('input, textarea', '#comanda-add-product-obss').on('focus');
    });
    $('#comanda-add-product-obss').live('pagehide',function(event, ui){    
        $('input, textarea', '#comanda-add-product-obss').on('focus');
    });
    

    $(document).on('pageshow','#comanda-add-menu', function(){     
        

        // boton para mostrar el formulario de observacion
        $('#comanda-obervacion-a').on('click', function(){
            $('#comanda-add-observacion').toggle('slow');
            $('textarea','#comanda-add-observacion').focus();
        });
        
     
        $('#ul-productos-seleccionados').on(
            'click',
            '.ui-options-btn',
            function(){
                var $ops = $(this).parent().find('.ui-options'),
                $opsBtn = $(this).parent().find('.ui-options-btn');
                        
                if ( $opsBtn.hasClass('ui-options-btn-open') ) {
                    $ops.hide();
                    $opsBtn.removeClass('ui-options-btn-open');
                } else {
                    $ops.show();
                    $opsBtn.addClass('ui-options-btn-open');
                }
            }
            );            

        $('#comanda-add-guardar').on('click', function(){
            Risto.Adition.adicionar.currentMesa().currentComanda().save();
            Risto.Adition.menu.reset();
        });
        
        
        
        
        
        /**
         * Cuando estoy creando una comanda se selecciona un producto y 
         * este debe ser agregado al listado de productos de la currentMesa()
         */
        function productoSeleccionado(e) {
            Risto.Adition.adicionar.currentMesa().agregarProducto(e.producto);
        }

        //creacion de comandas
        // producto seleccionado
        $('#comanda-add-menu').on(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event , productoSeleccionado);        

        function seleccionar(){
            //retrieve the context
            var context = ko.contextFor(this);
            $(this).addClass('active');
            if (context) {
                // $data es es el objeto producto
                context.$data.seleccionar(this);
            }
        }

        $('#ul-categorias').on("tap", "a" , seleccionar);
        $('#ul-productos').on("tap", "a", seleccionar);
        
        
        // reinicializo a cero los valores si es swipeado quiere decir que lo borro de la lista
        $('#ul-productos-seleccionados').on('swipeleft','li',function(e){
            $(this).hide('slow', function(){
                    ko.contextFor(this).$data.cant(0); 
            });
        });
        
        
            
        // Eventos para la observacion General de la Comanda ADD
        (function(){
            var $domObs = $('#comanda-add-observacion');
            $("#mesa-comanda-add-obs-gen-cancel").on('click', function(){
                $domObs.toggle('slow'); 
                Risto.Adition.adicionar.currentMesa().currentComanda().comanda.borrarObservacionGeneral();
            });

            $("#mesa-comanda-add-obs-gen-aceptar").on('click', function(){
                $domObs.toggle('slow');
            });

            var domObsList = $('.observaciones-list button', '#comanda-add-menu');
            domObsList.on('click' , function(e){
                if ( this.value ) {
                    Risto.Adition.adicionar.currentMesa().currentComanda().comanda.agregarTextoAObservacionGeneral( this.value );
                }
            });
        })();
    });

    $(document).on('pagebeforehide','#comanda-add-menu', function(){
        console.info("me FUIII");
        $(document).on(  MENU_ESTADOS_POSIBLES.productoSeleccionado.event);
        
        $('#comanda-obervacion-a').on('click');
        
        $('a.active','#ul-productos').removeClass('active');
        
        $('#comanda-add-observacion').hide();
        
        $('#ul-categorias').undelegate("a", 'click');
        $('#ul-productos').undelegate("a", 'click');
        
        
        
        $('#ul-productos-seleccionados').undelegate(
            '.listado-productos-seleccionados',
            'mouseleave'
            );                
        
        $('#ul-productos-seleccionados').undelegate(
            '.ui-options-btn',
            'click'
            ); 
            
            

        $("#mesa-comanda-add-obs-gen-cancel").on('click');
        $("#mesa-comanda-add-obs-gen-aceptar").on('click');
        $('.observaciones-list button', '#comanda-add-menu').on('click');
        $('#comanda-add-guardar').on('click');
        
    });

})();