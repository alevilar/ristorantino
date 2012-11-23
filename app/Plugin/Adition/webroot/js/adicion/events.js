/*-----------------------------------------   Adition EVENTS
 *
 *
 * Adition Events
 * el el script que capura los eventos de la pagina adition.php[ctp]
 */

// mensaje de confirmacion cuando se esta por salir de la pagina (evitar perdidas de datos no actualizados)
//window.onbeforeunload=confirmacionDeSalida;



/**
 *JQM 
 * renderizado de cosas que se cargan dinamicamente en javascript
 * en cada cambio de pagina, hacemos que se  vuelva a refrescar JQM 
 * para enriquecer los elementos nuevos
 *
 */

$(document).bind("mobileinit", function(){

    $('#comanda-add-product-obss').live('pageshow',function(event, ui){    
        $('input, textarea', '#comanda-add-product-obss').bind('focus');
    });
    $('#comanda-add-product-obss').live('pagehide',function(event, ui){    
        $('input, textarea', '#comanda-add-product-obss').unbind('focus');
    });
    
    


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






    /**
     *
     *
     *          COMANDA ADD
     *
     */
    $('#comanda-add-menu').live('pageshow', function(){
        $('#speach-search').bind('webkitspeechchange change', function(e){
            if ( e.srcElement.value ) {
                $('#comanda-search-productos-container').load(urlDomain+'productos/buscar_por_nombre/'+e.srcElement.value, function() {
                  $( '#searched-productos-container' ).show();
                });
            }
        });
        
        // show or hide hirschary
        $('.active', '#comanda-add-menu').hide();
        $('.root').show().addClass('active');
        
        $('#comanda-add-menu').delegate(
                '.categoria',
                'click', function() {
                    $('.active', '#comanda-add-menu').hide().removeClass('active');
                    $($(this).attr('href')).show().addClass('active');
                }
            );
        
        $('#comanda-add-menu').delegate(
                '.producto',
                'click', function() {
                    var prod = JSON.parse( $(this).attr('data-producto-json') ),
                        comanda = Risto.Adition.adicionar.currentMesa().currentComanda();
                    
                    if ( $(this).hasClass('producto-con-sabor') ) {
                        // Evento para los productos con sabores

                        var productoElement = this;

                        function unloadSabores() {
                               $('.content', $('.ul-sabores', '#comanda-add-menu')).undelegate("a", "click");
                               $('.ul-sabores', '#comanda-add-menu').undelegate("a.cancel", 'click');
                               $('.ul-sabores', '#comanda-add-menu').undelegate("a.save", 'click');
                               $('.ui-btn-active', $('.ul-sabores', '#comanda-add-menu')).removeClass('ui-btn-active');
                        }
                        
                        // Seleccionar sabores añadiendo una clase si esta activo o no
                        $('.content', $('.ul-sabores', '#comanda-add-menu')).delegate("a", "click", function(){
                            $(this).toggleClass('ui-btn-active');
                        });

                        // Al salir de la ventana de sabores
                        $('.ul-sabores', '#comanda-add-menu').delegate("a.cancel", 'click', unloadSabores);
                        
                        // Al guardar los sabores seleccionados
                        $('.ul-sabores', '#comanda-add-menu').delegate("a.save", 'click', function (){
                             var $losActivos = $('.ui-btn-active', $('.ul-sabores', '#comanda-add-menu')),
                                sabores = [];
                                
                            $losActivos.each(function(i, e){
                                sabores.push(JSON.parse($(e).attr('data-sabor-json')));
                            });
                            prod.Sabor = sabores;
                            $losActivos.removeClass('ui-btn-active');
                            
                            var ProductoSeleccionado = comanda.agregarProducto(prod);
                            if (!productoElement.isKoBinded) {
                                $(productoElement).prepend(  '<span class="cantidad ui-li-count ui-btn-up-c ui-btn-corner-all" data-bind="text: cant"></span>' );
                                ko.applyBindings(ProductoSeleccionado, productoElement);
                                productoElement.isKoBinded = true;
                            }
                            unloadSabores();
                        });
                    } else {
                        var ProductoSeleccionado = comanda.agregarProducto(prod);
                        if (!this.isKoBinded) {
                            $(this).prepend(  '<span class="cantidad ui-li-count ui-btn-up-c ui-btn-corner-all" data-bind="text: cant"></span>' );
                            ko.applyBindings(ProductoSeleccionado, this);
                            this.isKoBinded = true;
                        }
                        return ProductoSeleccionado;
                    }
                }
            );           
        
        $('#comanda-add-guardar').bind('click', function(){
            Risto.Adition.adicionar.currentMesa().currentComanda().save();
        });

           
        // Eventos para la observacion General de la Comanda ADD
        (function(){
            
            $("#mesa-comanda-add-obs-gen-cancel").bind('click', function(){
                Risto.Adition.adicionar.currentMesa().currentComanda().comanda.borrarObservacionGeneral();
            });
            
            var domObsList = $('.observaciones-list button', '#comanda-add-menu');
            domObsList.bind('click' , function(e){
                if ( this.value ) {
                    Risto.Adition.adicionar.currentMesa().currentComanda().comanda.agregarTextoAObservacionGeneral( this.value );
                }
            });
        })();
        
    });
       

    $('#comanda-add-menu').live('pagebeforehide', function(){
        
        $('#comanda-add-observacion').hide();
        
        $('#comanda-add-menu').undelegate(
                '.categoria',
                'click');
        
        $('#comanda-add-menu').undelegate(
                '.producto',
                'click');
        
        $('#comanda-add-menu').undelegate("a", "click");
        
        $('#ul-productos-seleccionados').undelegate(
                '.listado-productos-seleccionados',
                'mouseleave'
        );                
        
        $('.ul-productos-seleccionados').undelegate(
                '.ui-options-btn',
                'mouseover'
        ); 

        $("#mesa-comanda-add-obs-gen-cancel").unbind('click');
        $("#mesa-comanda-add-obs-gen-aceptar").unbind('click');
        $('.observaciones-list button', '#comanda-add-menu').unbind('click');
        $('#comanda-add-guardar').unbind('click');
        
        $('#speach-search').unbind('webkitspeechchange change');
        
    });






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
            $raeh.trigger('cambiarNumeroMesa', null, this);
            return false;
        });
    });

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-cambiar-numero').live('pagebeforehide',function(event, ui){ 
        // Form SUBMITS
         $('#form-cambiar-numero').unbind( 'submit');
    });
    
    
    
    
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
    
    
    


    /**
     *
     *
     *          Mesa View
     *
     *
     */

    // enrquiqueecr con JQM el listado ed comandas de la mesa en msa-view
    $('#mesa-view').live('pageshow',function(event, ui) {
        $('#comanda-detalle-collapsible').trigger('create');

         // CLICKS
        $('#mesa-action-comanda').bind( 'click', function(){
            Risto.Adition.adicionar.nuevaComandaParaCurrentMesa();
        });

        $('#mesa-action-cobrar').bind('click',function(){
            Risto.Adition.adicionar.pagos( [] );
        });
        
        var $hrefEdit = $('#mesa-action-edit'),
            hrefToEditMesa = $hrefEdit.attr('data-href');
        if ( hrefToEditMesa ) {
            $hrefEdit.attr('href', hrefToEditMesa + Risto.Adition.adicionar.currentMesa().id() + '.jqm');
        }


          $('#mesa-cant-comensales').bind('click', function(){
              Risto.Adition.adicionar.agregarCantCubiertos();
          });


        $('#mesa-cerrar').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.cerrada );
        });

        $('#mesa-action-reimprimir').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });


        $('#mesa-borrar').bind('click', function(){
            if (window.confirm('Seguro que desea borrar la mesa '+Risto.Adition.adicionar.currentMesa().numero())){
                var mesa = Risto.Adition.adicionar.currentMesa();
                mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.borrada );
            }
        });


        $('#mesa-reabrir').bind('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });

    });

    $('#mesa-view').live('pagebeforehide',function(event, ui){  
        $('#mesa-action-comanda').unbind( 'click');
        $('#mesa-action-cobrar').unbind('click');
        $('#mesa-cant-comensales').unbind('click');
        $('#mesa-cerrar').unbind('click');
        $('#mesa-action-reimprimir').unbind('click');
        $('#mesa-borrar').unbind('click');
        $('#mesa-reabrir').unbind('click');
    });




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






    /**
     *
     *      LISTADO DE MESAS
     *
     *
     */


    $('#listado-mesas').live('pageshow',function(event, ui){
        var $listadoMozos = $('#listado-mozos-para-mesas');
        $listadoMozos.removeClass('ui-grid-a');


        // al hacer click n un mozo del menu bar
        // se muestran solo lasmesas de ese mozo

        $listadoMozos.delegate('a', 'click', function(e) {
            $raeh.trigger('mostrarMesasDeMozo', e.currentTarget);
            return false;        
        });

    });


    $('#listado-mesas').live('pagebeforehide',function(event, ui){
        $('#mesa-abrir-mesa-btn').unbind('click');
        $('#listado-mozos-para-mesas').unbind('click');
        
        // al hacer click n un mozo del menu bar
        // se muestran solo lasmesas de ese mozo
        var $listadoMozos = $('#listado-mozos-para-mesas');
        $listadoMozos.undelegate('a', 'click');
        
        
    });
    
    
    
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
     
    

    /**
     *
     *          COBROS               -------    CAJERO
     *
     */
    $('#mesa-cobrar').live('pageshow',function(event, ui){
        $('#mesa-cajero-reabrir').bind('click',function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            mesa.cambioDeEstadoAjax( MESA_ESTADOS_POSIBLES.reabierta );
        });
        $('.mesa-reimprimir', '#mesa-cobrar').bind('click', function(){
            var mesa = Risto.Adition.adicionar.currentMesa();
            var url = mesa.urlReimprimirTicket();
            $.get(url);
        });
    });

    $('#mesa-cobrar').live('pagebeforehide',function(event, ui){
        $('#mesa-cajero-reabrir').unbind('click');
        $('.mesa-reimprimir', '#mesa-cobrar').unbind('click');
        Risto.Adition.adicionar.pagos([]);
    });


    /**
     *
     *          OPCIONES    ----   CAJERO
     *
     */
    $('#cajero-opciones').live('pageshow',function(event, ui){
        $('#modo-k').bind('change',function(){
            Risto.IMPRIME_REMITO_PRIMERO = !Risto.IMPRIME_REMITO_PRIMERO;
            $.get(urlDomain+'/configs/toggle_remito');

        });
    });

    $('#cajero-opciones').live('pagebeforehide',function(event, ui){
         $('#modo-k').unbind('change');
    });


    /**
     *
     *          CLIENTES LISTADO
     *
     */
    $('#listado_de_clientes').live('pageshow',function(event, ui){

        $('input', '#contenedor-listado-clientes-factura-a').bind('keypress', function(){
                    $('.factura-a-cliente-add').show();
         });

        $('#mesa-eliminar-cliente').bind('click',function(){
            Risto.Adition.adicionar.currentMesa().setCliente( null );
            return true;
        });

    });

    $('#listado_de_clientes').live('pagebeforehide',function(event, ui){

        $('#mesa-eliminar-cliente').unbind('click');
        $('input', '#contenedor-listado-clientes-factura-a').unbind('keypress');
    });
    
    
    /**
     *
     *          DESCUENTOS LISTADO
     *
     */
    $('#descuentos-jqm_descuentos').live('pageshow',function(event, ui){

        $('#mesa-eliminar-descuento').bind('click',function(){
            Risto.Adition.adicionar.currentMesa().eliminarDescuento( );
            return true;
        });

    });

    $('#mesa-eliminar-descuento').live('pagebeforehide',function(event, ui){
        $('#mesa-eliminar-cliente').unbind('click');
    });
    



    /**
     *
     *
     *    Agregar Clientes ADD
     */
    $('#clientes-addfacturaa').live('pageshow', function() {
        var $fform = $('#form-cliente-add', '#clientes-addfacturaa');
        $fform.bind('submit', function(e){
          var contenedorForm = $fform.parent();
           e.preventDefault();
           $.post(
               $fform.attr('action'), 
               $fform.serialize(),
               function(data){
                   contenedorForm.html(data);
                   contenedorForm.trigger('create');
                   contenedorForm.trigger('refresh');
               }
           );
           return false; 
        });
    });
    
    $('#clientes-addfacturaa').live('pagehide', function() {
        $('#form-cliente-add', '#clientes-addfacturaa').unbind('submit');
    });


    /**
     *
     *
     *          Page COBRAR
     *
     */
    $('#mesa-cobrar').live('pageshow', function(){

        // Al apretar el boton de cobro de pago procesa los pagos correspondientes
        $('#mesa-pagos-procesar').bind('click', function(){
            // lipieza de pagos, selecciono solo los que se les haya agregado algun valor en el input
            for (var p in Risto.Adition.adicionar.pagos() ) {
                if ( Risto.Adition.adicionar.pagos()[p] ) {
                    // agrego el pago a la mesa
                    Risto.Adition.adicionar.currentMesa().Pago.push( Risto.Adition.adicionar.pagos()[p] );
                }
            }

            // reinicio los pagos
            Risto.Adition.adicionar.pagos([]);

            // cambio el estado de la mesa para disparar el evento
            Risto.Adition.adicionar.currentMesa().setEstadoCobrada();
        });
    });

    $('#mesa-cobrar').live('pagebeforehide', function(){
        $('#mesa-pagos-procesar').unbind('click');
    });


});


/**
 *
 *                  Eventos ONLOAD
 *
 *
 */ 
$(document).ready(function() {   
  
   hacerQueNoFuncioneElClickEnPagina();
    
    $(document).keydown(onKeyDown);
    $(document).keypress(onKeyPress);
    
    
     // Los botones que tengan la clase silent-click sirven para los dialogs
    // la idea es que al ser apretados el dialog se cierre, pero que se envie 
    // el href via ajax, Es util para las ocasiones en las que quiero mandar
    // una accion al servidor del cual no espero respuesta.    
    $('[data-href]').bind('click',function(e){
        var att = $(this).attr('data-href');
        if (att) {
            $.get( att );
        }
        $('.ui-dialog').dialog('close');
    });   
});



/**
 * Cuando estoy creando una comanda se selecciona un producto y 
 * este debe ser agregado al listado de productos de la currentMesa()
 */
function productoSeleccionado(e) {
    Risto.Adition.adicionar.currentMesa().agregarProducto(e.producto);
}




function confirmacionDeSalida(e) {
	if(!e) e = window.event;
	//e.cancelBubble is supported by IE - this will kill the bubbling process.
	e.cancelBubble = true;
	e.returnValue = 'Seguro que deseas salir de la aplicación?\n si no hay datos guardados, los mismos se perderán'; //This is displayed on the dialog

	//e.stopPropagation works in Firefox.
	if (e.stopPropagation) {
		e.stopPropagation();
		e.preventDefault();
	}
    }
    


/**
 *
 *@param String to. es una funcion de jQuery que hace ir para adelante o para atras en la dom 
 *se puede poner: 
 *                  'next' (por default) busca el siguiente elemento
 *                  'prev' busca el anterior
 */
function __irMesaTo(to) {
    var toWhat = to || 'next';
    
    var mesaContainer = $('.listado-adicion', $.mobile.activePage );
    
    if ( !mesaContainer ) {
        return;
    }

    if ( Risto.Adition.mesaCurrentContainer && Risto.Adition.mesaCurrentContainer.attr('id') != mesaContainer.attr('id') ){
        Risto.Adition.mesaCurrentIndex = null;
    }
    
    Risto.Adition.mesaCurrentContainer = mesaContainer;
        
    if ( Risto.Adition.mesaCurrentIndex !== null) {
        var aaa = Risto.Adition.mesaCurrentIndex.parent()[toWhat]().find('a');
        if ( aaa.length ) {
            Risto.Adition.mesaCurrentIndex = aaa;
        } else {
            return;
        }
    } else {
        Risto.Adition.mesaCurrentIndex = Risto.Adition.mesaCurrentContainer.find('a').first();
    }
    Risto.Adition.mesaCurrentIndex.focus();
}
  

function irMesaPrev() {
    __irMesaTo('prev');
    
}

function irMesaNext() {
    __irMesaTo('next');
}


function onKeyDown(e) {
    var code = e.which;
    
    // al apretar la tecla back, volver atras, menos cuando estoy en un INPUT o TEXTAREA
    if (code == 8 ) { // tecla backspace
        if (document.activeElement.tagName.toLowerCase() != 'input' && document.activeElement.tagName.toLowerCase() != 'textarea') {
            history.back();
        }
    }
    
    
    // Ctrol DERECHO + M ir a modo Cajero
    if( (code == 'l'.charCodeAt() || code == 'L'.charCodeAt()) && e.ctrlKey) {
        var pageId = $.mobile.activePage.attr('id');
        
        if ( pageId == 'listado-mesas-cerradas' ) {
            $.mobile.changePage('#listado-mesas');
        }
        
        if ( pageId == 'listado-mesas' ) {
            $.mobile.changePage('#listado-mesas-cerradas');
        }
        return false;
    }        
    
    
    if(code == 23 && e.ctrlKey) {
        $.mobile.changePage('#mesa-view')
    }
        
    
    // mesa siguiente a la seleccionada (focus) del listado de mesas
    if (code == 39 ) { //btn flecha derecha
        irMesaNext();
    }
    
    // mesa anterior a la seleccionada del listado de mesas
    if (code == 37 ) { // boton flecha izq
        irMesaPrev();
    }
}

var oldTimeOut;
function onKeyPress(e) {
    var code = e.which;
    if ( code > 47){ // desde el numero 0 hasta la ultima letra con simbolos
        
        // buscar la mesa con ese numero, busca por accesskey
        Risto.Adition.mesaBuscarAccessKey += String.fromCharCode( code );
        var domFinded = $("[accesskey^='"+Risto.Adition.mesaBuscarAccessKey+"']", $.mobile.activePage);
        if ( domFinded.length ) {
            Risto.Adition.mesaCurrentIndex = $(domFinded[0]);
            domFinded[0].focus();
        }
        
        if(oldTimeOut){
            clearTimeout(oldTimeOut);
        }
        oldTimeOut = setTimeout(function(){
            Risto.Adition.mesaBuscarAccessKey = '';
        },1000);
    }
}



/**
 *  para que no titile el cursor. Que no se pueda hacer click
 */
function hacerQueNoFuncioneElClickEnPagina() {
    return 1;
   if(document.all){
      document.onselectstart = function(e) {return false;} // ie
   } else {
      document.onmousedown = function(e)
      {
         if(e.target.type!='text' && e.target.type!='button' && e.target.type!='textarea') return false;
         else return true;
      } // mozilla
   }
}