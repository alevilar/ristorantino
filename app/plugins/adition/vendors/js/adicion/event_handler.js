/**
 * 
 * @scope Risto.Adition
 * 
 * EventHandler
 * 
 * Maneja la DOM
 * Es el encargado de capturar los eventos relacionados con la adicion
 * 
 */

$raeh = Risto.Adition.EventHandler = {
    
    trigger: function( eventName, extra, context ) {  
        if ( Risto.Adition.EventHandler.hasOwnProperty(eventName ) && typeof Risto.Adition.EventHandler[eventName] == 'function') {
                if ( context ) {
                    setTimeout(function(){
                        Risto.Adition.EventHandler[eventName].call(context, extra);
                    }, 1);
                } else {
                    setTimeout(function(){
                        return Risto.Adition.EventHandler[eventName].call(this, extra);
                    }, 1);
                }
        }
        
        return -1;
    },
    
    mesaAbierta: function(e) {
        if (!e.mesa.id) {
            setTimeout(function(){
                abrirMesa(e)
            },1000);
        }
    },
    
    mesaCerrada: function(e){
    },
    
    
    /**
     * 
     *  Procesar los pagos de la mesa
     */
    mesaCobrada: function(e){
        // envio los datos al servidor
        var m = e.mesa;
        var mes = {
            Mesa: {
                id: m.id(),
                estado_id: m.estado_id(),
                time_cobro: m.time_cobro(),
                model: 'Mesa'
            },
            Pago: m.Pago()
        };
        
        // guardo los pagos
        $cakeSaver.send({
            url: urlDomain+'pagos/add',
            obj: mes
        }, function(d){
            
        });
        
        e.mesa.mozo().sacarMesa( e.mesa );
        
    },
    
    mesaBorrada: function(e){
        var mesa = e.mesa;
        e.mesa.mozo().sacarMesa(mesa);
    },
    
    mesaSeleccionada: function(e){
        Risto.Adition.adicionar.setCurrentMesa(e.mesa);
    },
    
    
    /**
     *  Llama a una funcion dependiendo de la pagina en la que estoy
     *  sirve para realizar las mismas acciones de inicializacion, o preparacion
     *  de alguna pagina despues de haber realizado una determinada accion
     *  Utiliza funciones de JQM para determinar la pagina actual
     */
    adicionMesasActualizadas: function () {
        /**
         *
         *  definicion del objeto que manejara las distintas respuestas dependiendo de la pagina activa
         *  Cada clave de este objeto es el ID de la page de JQM utilizada
         *  
         * */
        var onMesasActualizadasHandlerByPage = {
            'listado-mesas': function(){
                var btnMozo = $('#listado-mozos-para-mesas .ui-btn-active'),
                    mozoId = 0;
                if ( btnMozo[0] ) {
                    mozoId = $(btnMozo[0]).attr('data-mozo-id');
                }
                $raeh.mostrarMesasDeMozo(mozoId);
            },
            'mesa-view': function() {
                $('#comanda-detalle-collapsible').trigger('create');
            }
        }
        
        // llamar a la funcion correspondiente segun la pagina en la que estoy
        if ( $.mobile.activePage[0].id && onMesasActualizadasHandlerByPage.hasOwnProperty( $.mobile.activePage[0].id) ) {
            onMesasActualizadasHandlerByPage[$.mobile.activePage[0].id].call();
        }
    },
    
    
    adicionCambioMozo: function(){
        return 1;
    },
    
    
    
    

    cambiarMozo: function(e){    
        var mozoId = $(this).find('[name="mozo_id"]:checked').val();
        var mozo = Risto.Adition.adicionar.findMozoById(mozoId);
        var mozoAnterior = Risto.Adition.adicionar.currentMesa().mozo();
        Risto.Adition.adicionar.currentMesa().setMozo( mozo );

        $('.ui-dialog').dialog('close');

        var sendOb = {
            obj: {
                id: Risto.Adition.adicionar.currentMesa().id(),
                mozo_id: mozoId,
                model: 'Mesa',
                handleAjaxSuccess: function(){}
            },
            url: Risto.Adition.adicionar.currentMesa().urlEdit(),
            error: function(){
                Risto.Adition.adicionar.currentMesa().setMozo( mozoAnterior );
                alert("debido a un error en el servidor, el mozo no fue modificado");
            }
        }

        $cakeSaver.send(sendOb);

        return false;
    },

    cambiarNumeroMesa: function() {
        var numeroMesa = $(this).find('[name="numero"]').val(),
            selfMesa = Risto.Adition.adicionar.currentMesa(),
            numAnt = selfMesa.numero( ),
            onSuccess = function(){},
            onError = function(){
                selfMesa.numero( numAnt );
                alert("debido a un error en el servidor, el numero de mesa no fue modificado");
            }        
        selfMesa.numero( numeroMesa );
        $('.ui-dialog').dialog('close');

        selfMesa.saveField('numero', numeroMesa, onSuccess, onError);
            
        return false;
    },
    
    
    
    
    /**
     * 
     * Dado un listado de mesas, solo deja visibles las que fue seleccionado su mozo
     * Es utilizado en el listado de mesas
     * 
     */
    mostrarMesasDeMozo: function( domObj ) {   
        if ( domObj == undefined ) {
            domObj = 0;
        }
        
        var mozoId;
        if ( typeof domObj == 'number') {
            mozoId = domObj;    
        } else {
            mozoId = domObj.getAttribute('data-mozo-id');   
        }
        
        $mesasDom.show();
        $('a.ui-btn-active', $listMozosContainer).removeClass('ui-btn-active');
        if ( mozoId ) {
                $( 'li[mozo!='+mozoId+']', $mesasContainer).hide();
                $( 'li[mozo='+mozoId+']', $mesasContainer).show();
                $('a[data-mozo-id='+mozoId+']', $listMozosContainer).addClass('ui-btn-active');
        } else {
            $listMozosContainer.find('a:first' ).addClass('ui-btn-active');
            $('li', '#mesas_container' ).show();
        }
    }
    
}