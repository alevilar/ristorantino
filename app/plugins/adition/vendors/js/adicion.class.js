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
    
var Adicion = function(mozo) {

    this.currentMozo = mozo || new Mozo();
    this.currentMesa = null;

    this.mozos = [];
    this.mesas = [];

    // list de botones que van como controllers en los menu
    this.__buttons = [];
    

    this.productos = [];


    // esta es la comanda que se genera al sacar un Item de un DetalleMesa
    this.comandaSacar = null;

    /**
     *  Crear la comandera y el menu
     *  para el mozo actual y la mesa actual
     */
    this.comanda = null;  //este objeto se crea con el evento window onload


    this.cubiertosObligatorios = true;



}

Adicion.prototype = {


    mesasButonizadas: function() {
        var btns = [];
        for each(var m in this.mesas) {
            btns.push(m.getButton());
        }
        return btns;
    },

    mozosButonizados: function() {
        var btns = [];
        for each(var m in this.mozos) {
            btns.push(m.getButton());
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
        var cubiertosObligatorios = cubiertosObligatorios || 'undefined';

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


    ticketView: function(elementToUpdate){
        var url = document.referrer+'mesas/ticket_view' + '/'+this.currentMesa.id ;
        $(elementToUpdate).load(url);
    },


    cambiarNumeroMesa: function(){
        var numero = prompt('Nuevo Número de Mesa',this.currentMesa.numero);
        var ops = {
                'data[Mesa][numero]': numero
            };
        this.currentMesa.editar(ops);
    },



    /**
     * Le agrega al boton la logica corerspondiente para manejar
     * un evento "click"
     *
     * @param btn boton
     */
    __addButtonOnclickLogic: function (btn){
        var adicion = this;
        if (btn.id ) {
            $( btn ).click(function(){
               var container = adicion['onclick'].call();
               container.pagesman();
            });

            
        } else {
            if (window.console){
                console.error("Ojo! el boton no tiene ID, debe tenerlo para que funcione");
                console.debug(btn);
            }
        }
        return btn;
    },


    /**
     *  Agrega un nuevo boton al menu indicado
     *  @param btnElementId String|Object Id del boton. Si es un bojecto tenjgo que pasarle un json con lso atributos del elemento. El atributo "text" escribe el tecxo a mostrar en el boton
     *  @param onClick function event handler
     *  @param ops Object
     *              display default 'inline', puede ser block. es la propiedad CSS
     *              menu nombre del elemnto donde voy a atachar el boton
     *
     *  @return Element button Devuelve el nuevo boton creado
     */
    addButton: function(btnElementId, onClick,  display) {
            var dis = display || 'inline';
            if (btnElementId && btnElementId.display ) {
                dis = btnElementId.display;
            }
            
            var menuName = '.window_controll';
            if (btnElementId && btnElementId.menu ) {
                menuName = btnElementId.menu;
            }            
            var menu = $(menuName);
            if ( $('.page:visible > ' + menuName).length ) {
                menu = $('.page:visible > '+menuName);
            }
            
            var btn = {};
            if (typeof btnElementId == 'object') {
                // genero un nuevo boton
                btn = document.createElement('button');
                // inserto todos los atributos que vinieron en el objeto btnElementId
                for (var i in btnElementId) {
                    if (typeof btnElementId[i] == 'function') {
                        btn[i] = btnElementId[i];
                    } else {
                        // si el atributo tiene el nombre "text" quiere decir que voy
                        // a ingresarlo como texto dentro del html
                        if (i == 'text') {
                            $(btn).html(btnElementId[i]);
                        } else if ('id') {
                            continue;
                        } else {
                            $(btn).attr(i, btnElementId[i]);
                        }
                    }
                }
                // si no existe el type que sea button por default
                if ( !btn.type ) {
                    btn.type = 'button';
                }
                // lo agrego al listado de botones generados, para no generar 2 veces
                this.__pushButton(btnElementId.id, btn);
            } else if ( typeof btnElementId == 'string' ) {
                // si vino un string en lugar de un objeto es porque
                // quiero agarrar un boton previamente generado
                btn = this.__getButton(btnElementId);
            }

            // meto el boton en el menu
            $(btn).appendTo(menu);
            $(btn).css({display: dis});

            $( btn ).click(function(e){
                if (onClick) {
                    // ejecutar el evento oclick y luego, con el contenedor que devuelve
                    // meterlo en algun contenedr con pagesman
                    var ret = onClick();
                    if (ret) {
                        ret.pagesman();
                    }
                }
            });
            
            return $(btn);
    },


    /**
     *  Devuelve el boton del listado de botones segun el ID del elemento
     */
    __getButton: function (elId) {
        return this.__buttons[elId];
    },

    /**
     * AGrega un boton al listado de botones de la adicion
     *
     */
    __pushButton: function(elId, btn){
        this.__buttons[elId] = btn;
        return btn;
    },


    /**
     * Me indica si un metodo existe
     * @param  methodName string nombre del metodo
     * @returns boolean
     */
    methodExists: function(methodName) {
        var ret = false;
        if ( this.hasOwnProperty(methodName) ) {
            ret = true;
        }
        return ret;
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

        var ajaxResp = $.get(
                urlDomain + 'mozos/mesas_abiertas.json',
                function(e,t){
                    context.__handleMesasAbiertas(e, t)
                },
                'json'
            );
                
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
