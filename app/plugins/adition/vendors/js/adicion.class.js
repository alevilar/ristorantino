/**
 *  Adicion Class
 *
 *  constructor
 *
 */


/**
 * extencion del objeto array
 *
 *
 * */
    
var Adicion = function(mozo){
    
    this.urlMesaView = document.domain + '/Mesas/view';

    this.currentMozo = mozo || new Mozo();

    this.currentMesa = null;

    this.mozos = [];

    this.mesas = [];


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
     *  devuelve un listado de Buttons (form buttons)
     *  del listado de objetos "objname" que le pase como parametro
     */
    butonizar: function(list, objname){
        var obj = objname || 'obj';
        var btns = [];
        for each(var i in list) {
            var el = document.createElement('button');            
            el[obj] = i;
            btns.push(el);
        }
        return btns;
    },

    nombrificar: function(list, text) {
        for each (var i in list) {
            i.innerHTML = i.obj[text];
        }
        return list;
    },

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
    	
		
    borrarCurrentMesa: function(){
        this.currentMesa = null
    },

    setCurrentMesa: function(mesa) {
        this.currentMesa = mesa;
        if (mesa.Mozo) {
            this.currentMesa = mesa.Mozo;
        }
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
                        var okCerrar = window.confirm("Se va a cerrar la mesa Nº "+this.currentMesa.numero);

                        if ( okCerrar ) {
                            this.currentMesa.cerrar()
                        }
                        return okCerrar;
                    }
                    else{
                        mensajero.error("No se puede cerrar una mesa que no tiene productos cargados.");
                        return -1;
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

    /**
     *  Agrega un nuevo boton al menu indicado
     *  @param String|Object btnElementId Id del boton. Si es un bojecto tenjgo que pasarle un json con lso atributos del elemento. El atributo "text" escribe el tecxo a mostrar en el boton
     *  @param String menuContainerElementId Id del menu
     *  @param String display default 'inline', puede ser block. es la propiedad CSS
     */
    addButton: function(btnElementId, menuContainerElementId, display) {
        return $(function(){
            var dis = display || 'inline';
            var btn = {};
            console.info("addButton");
            if (typeof btnElementId == 'object') {
                btn = document.createElement('button');
                for (var i in btnElementId) {
                    if (typeof btnElementId[i] == 'function') {
                        btn[i] = btnElementId[i];
                    } else {
                        if (i == 'text') {
                            $(btn).html(btnElementId[i]);
                        } else {
                            $(btn).attr(i, btnElementId[i]);
                        }
                        
                    }
                    
                }
            } else {
                btn = document.getElementById(btnElementId);
            }
            console.debug(btn);
            var menu = document.getElementById(menuContainerElementId);
            menu.appendChild(btn);
            btn.style.display = dis;
            return btn;
        })
    },

    /**
     * Extiende la adicion agregando nuevos metodos
     * arroja error si el nombre del metodo ya existe
     */
    addMethod: function(methodName, fn) {
        if ( this.hasOwnProperty(methodName) ) {
            $.error("no se puede sobreescribir un metodo. EL metodo o propiedad "+methodName+" ya existe.");
        } else {
            this[methodName] = fn;
        }
        return this;
    },

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
    


    getMesasAbiertas: function(){
        var context = this;
        var ajaxResp = $.get(urlDomain + 'mesas/abiertasPorMozo.json', function(e,t){
            context.__handleMesasAbiertas.call(context, e, t)
        });
        console.info('Mesas abiertas');
        console.debug(ajaxResp);
        
        ajaxResp.error = function(){alert("fallo conexión")}
    },
    

    __handleMesasAbiertas: function( data ) {
        var mozos = [];
        var mesas = [];
        for each (d in data) {
            var mo = new Mozo();
            mo.cloneFromJson(d.Mozo)
            mozos.push(mo);
            for each (a in d.Mesa) {
                var me = new Mesa();
                me.cloneFromJson(a)
                me.setMozo(mo);
                mo.mesas.push(me);
                mesas.push(me);
            }
        }
        this.mozos = mozos;
        this.mesas = mesas;
    }

		
};