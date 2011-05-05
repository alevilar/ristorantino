/**
 *  Adicion Class
 *
 *  constructor
 *
 */
var Adicion = function(mozo){
    
    this.urlMesaView = document.domain + '/Mesas/view';

    this.currentMozo = mozo || new Mozo();

    this.currentMesa = null;

    this.mozos = [];


    // esta es la comanda que se genera al sacar un Item de un DetalleMesa
    this.comandaSacar = null;

    /**
     *  Crear la comandera y el menu
     *  para el mozo actual y la mesa actual
     */
    this.comanda = null;  //este objeto se crea con el evento window onload

}

Adicion.prototype = {
    /**
     * Me dice si tiene una mesa setteada
     * @return boolean
     */
    tieneMesaSeleccionada: function(){
        var retornar = false;
        if(adicion.currentMesa){
            if(adicion.currentMesa.estaAbierta())
                retornar = true;
            else
                retornar = false;
        }
        else{
            retornar = false;
        }
        return retornar;
    },
    	
		
    /**
     * Inicializa la adicion volviendo a resetear los aspectos visuales
     * @return
     */
    resetear: function(){
        var idMesa = this.currentMesa.getId();

        this.borrarCurrentMesa();
        
        // saca la pestaña de la mesa activada y la pone como las demas
        $('#mesa-ver-'+idMesa).removeClass('mesa-seleccionada');
			
        // el contenedor de items actuales de una mesa
        $('#mesa-scroll').html("Seleccione una mesa");
			
        $('#boton-cliente').removeClass('boton-apretado');

        $('#boton-menu').removeClass('boton-apretado');
        $('#boton-menu').html('Menú');
        
        $('#btn-comensales').html('Cubiertos');
        $('#btn-comensales').removeClass('boton-apretado');
    },
		
		
    borrarCurrentMesa: function(){
        this.currentMesa = null
    },
		
		
    cambiarMozo: function(mozoCambiar){
        this.currentMozo = mozoCambiar;

        // modifico los botones de la DOM que hacen referencia al Mozo
        $(".mozo-numero").each(function(e){
            e.update(this.currentMozo.numero)
        }.bind(this));
        
        return this.currentMozo;
    },

    //cambia de mesa
    cambiarMesa: function(mesaCambiar){
        this.setCurrentMesa(mesaCambiar);

        this.comanda.resetearComanda(this.currentMozo, this.currentMesa);
					
        if(this.currentMesa)
        {            
            // del element listar_clientes.ctp
            $('#boton-cliente').removeClass('boton-apretado')
            if (this.currentMesa.tieneCliente()){
                $('#boton-cliente').addClass('boton-apretado');
            }
				
            // del element imprimir_como_menu.ctp
            $('#boton-menu').removeClass('boton-apretado')
            $('#boton-menu').html('Menú');
            if (this.currentMesa.tieneMenu()){
                $('#boton-menu').addClass('boton-apretado');
                $('#boton-menu').html('Menú X '+this.currentMesa.menu);
            }

            if (!this.currentMesa.estaAbierta()){
                $('#btn-cambio-rapido-de-mesa').addClass('mesa-cerrada');
            } else {
                $('#btn-cambio-rapido-de-mesa').removeClass('mesa-cerrada');
            }

            if (this.currentMesa.getCantComensales() > 0) {
                $('#btn-comensales').html(this.currentMesa.getCantComensales()+" Cubiertos").addClass('boton-apretado');
            } else {
                $('#btn-comensales').html('Indicar Cubiertos').removeClass('boton-apretado');
            }            
        }
			
                        
        // modifico en la DOM los botones que hcen referencia a esa mesa y mozo
        var mesaAux = this;
        $(".mesa-numero").each(function(e){
            e.html(mesaAux.currentMesa.numero);
        });
    },


    reabrirMesa: function(){
        var url = document.domain+'/mesas/ajax_edit';
        if (typeof(this.currentMesa) != 'undefined') {
            this.currentMesa.reabrir(url);
        }

        // para que topme la mesa como que esta cerrada sin necesidad de hacer un POST al server
        this.currentMesa.time_cerro = '0000-00-00 00:00:00';
        
        this.cambiarMesa(this.currentMesa);
        $('#todas-las-mesas-ver-'+this.currentMesa.id).removeClassName('mesa-cerrada');
        $('#mesa-ver-'+this.currentMesa.id).removeClassName('mesa-cerrada');
    },

    enviarACajero: function(){
        var url = document.domain+'/mesas/cerrarMesa';
        url = url + '/' + this.currentMesa.id + '/0';
        new Ajax.Request(url, {
            onSuccess: function() {
                this.__aplicarCierre();
            }.bind(this),
            onFailure: function(){
                alert("No se pudo cerrar la mesa")
            }
        });
    },


    borrarMesa: function(){
        var url = document.domain+'/mesas/delete';
        if (typeof(this.currentMesa) != 'undefined' && confirm('¿Eliminar la mesa n° '+this.currentMesa.numero+'?')) {
            this.currentMesa.borrar(url);
        }
    },


		
		
    /**
		 * con sta funcion se efectiviza el cierre de la currentMesa 
		 * enviando el mensaje al server e introduciendo mensajes
		 * por pantalla para el usuario
		 * 
		 */
    __aplicarCierre: function(){
        //  urlMesaCerrarMesa es una variable global creada en la adicion layout
        Dialog.info("Cerrando Mesa...", {
            width:250,
            height:100,
            showProgress: true
        });
        window.location.href = urlMesaCerrarMesa+"/"+this.currentMesa.id+"/mozo_id:"+this.currentMozo.id;
    },
		
		


    /**
     * // envia la mesa para ser cerrada
     * @param Boolean cubiertosObligatorios
     **/
    cerrarCurrentMesa: function(cubiertosObligatorios ){
        var confirma = false;
        
        cubiertosObligatorios = typeof(cubiertosObligatorios) === 'undefined' ? true : cubiertosObligatorios;

        if (this.tieneMesaSeleccionada()) {
            // si aun no se settearon la cantidad de comensales DEBE HACERLO !!
            if (cubiertosObligatorios && (this.currentMesa.getCantComensales() == 0) && (this.currentMozo.numero != 99)) {
                    showComensalesWindow();
            } else {
                if(this.tieneMesaSeleccionada()){
                    if(this.currentMesa.productos){
                        var windowConfirma  = Dialog.confirm(
                            "Se va a cerrar la mesa Nº "+this.currentMesa.numero,
                            {
                                width:300,
                                okLabel: "Aceptar",
                                /*	buttonClass: "myButtonClass",*/
                                id: "mesa-confirma-cierre",
                                onCancel: function(win) {
                                    confirma = false;
                                    return false
                                },
                                onOk:function(win) {
                                    this.__aplicarCierre();
                                    confirma = true;
                                    return true;
                                }.bind(this)
                            });
                        return confirma;
                    }
                    else{
                        mensajero.error("No se puede cerrar una mesa que no tiene productos cargados.");
                    }
                }
            } 
        } else {
            mensajero.error("Debe seleccionar una mesa para cerrar.");
            return -2;
        }	
    },


    ticketView: function(){
        var url = document.domain+'/mesas/ticket_view';
        new Ajax.Updater(
                    'mesa-scroll',
                    url+'/'+this.currentMesa.id,
                    {asynchronous:true,
                        evalScripts:true,
                        requestHeaders:['X-Update', 'mesa-scroll']}
                );
    },



    cambiarNumeroMesa: function(){
        var urlEdit = document.domain+'/mesas/ajax_edit';
        var numero = prompt('Nuevo Número de Mesa',this.currentMesa.numero);
        var mesaId = this.currentMesa.id;
        new Ajax.Request(urlEdit,
        {
            parameters: {
                'data[Mesa][id]': mesaId,
                'data[Mesa][numero]': numero
            },
            method: 'post',
            onSuccess: function(){
                parent.location.reload();
            },
            onFailure: function(){
                alert("Se ha perdido conexion con el servidor. Reintente.");
                contenedorCambiarMozosDeMesa.hide();
            }
        });
    },





/*******************------------ NUEVA VERSION --------------------------------************/
/*********----------------------------------------------------------------------*************/

    setMozos: function(mozos){
        var mozoaux;
        for each(var m in mozos){
            if (!$.isEmptyObject(m)) {
                
                mozoaux = new Mozo();
                mozoaux.cloneFromJson(m.Mozo);
                
                mozoaux.User = m.User;
                this.mozos.push(mozoaux);
            }
        }
    },


    setCurrentMozo: function(mozo){
        this.currentMozo = mozo;
        var event = $.Event('adicionCambioMozo');
        event.mozo = mozo;
        $(document).trigger(event);
    },


    /**
    * Esta funcion es para cuando yo abro una nueva mesa, me muestra el form input con un PAD numerico
    */
    abrirMesa: function(){
        var mesa = new Mesa();
        this.currentMesa = mesa;
        mesa.numero = window.prompt('introduzca número de mesa');

        // si no puso numero salir
        if (!mesa.numero) return;

        ventanas.ventanaSeleccionDeMozo(mesa.abrirlaConMozo, mesa);
    },


    getMesasAbiertas: function(){
        $.get(urlDomain + 'mesas/abiertasPorMozo', this.__handleMesasAbiertas);
    },

    __handleMesasAbiertas: function(data){
        console.info('mesas abiertas');
        console.debug(data);
    }

		
};