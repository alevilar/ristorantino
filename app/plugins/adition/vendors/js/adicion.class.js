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


    this.defaults = {
        // menu controlls para poner los botones, aca se debe especificar el selector DOM
        menuControlls: '.window_controll'
    }



}

Adicion.prototype = {


    mesasButonizadas: function() {
        var btns = [];
        for(var m in this.mesas) {
            btns.push(this.mesas[m].getButton());
        }
        return btns;
    },

    mozosButonizados: function() {
        var btns = [];
        for(var m in this.mozos) {
            btns.push(this.mozos[m].getButton());
        }
        return btns;
    },

    nombrificar: function(list, text) {
        for (var i in list) {
            list[i].innerHTML = list[i].obj[text];
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
        var url = window.urlDomain+'mesas/ticket_view' + '/'+this.currentMesa.id ;
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



    reinitMenuController: function(menuSelector) {
        var menu = menuSelector || this.defaults.menuControlls;
        $(menu).html('');
    },

    /**
     * Mete el boton registrado previamente con registerButon
     * en el menu indicado
     * @param btnSelector String ID o identificacion del boton
     * @param menuSelector String id o identificacion DOM del menu donde voy a appendear el boton
     */
    addButton: function(btnSelector, menuSelector) {
        var menu = menuSelector || this.defaults.menuControlls;

        if(typeof btnSelector == 'string') {
            btnSelector = [btnSelector];
        }
        
        
        for (var b in btnSelector ) {
            var btnSel = btnSelector[b];
            var btn = this.__getButton(btnSel);
            if ( btn ) {
                btn.appendTo(menu);
            } else {
                console.info('El boton no existe');
                console.debug(btnSel);
            }
        }
        
        return btn;
    },


    /**
     *  Agrega un nuevo al listado de botones disponibles para
     *  luego llamarlo con la funcion addButton
     *  
     *  @param jsBtn Object del boton. Es un json con los atributos del elemento. El atributo "text" escribe el tecxo a mostrar en el boton
     *  @param onClick function event handler
     *  @param ops Object
     *              display default 'inline', puede ser block. es la propiedad CSS
     *              menu nombre del elemnto donde voy a atachar el boton
     *
     *  @return Element button Devuelve el nuevo boton creado
     */
    registerButton: function(jsBtn, onClick,  display) {
            var dis = display || 'inline';
            if (jsBtn && jsBtn.display ) {
                dis = jsBtn.display;
            }
                        
            var btn = {};

            if (typeof jsBtn == 'object') {

                if ( jsBtn.hasOwnProperty('href') ) {
                    // genero un link
                    btn = document.createElement('a');
                    btn.href = jsBtn.href;
                    btn['class'] = 'button';
                } else {
                    // genero un boton
                    btn = document.createElement('button');
                }
                
                // inserto todos los atributos que vinieron en el objeto btnElementId
                for (var i in jsBtn) {
                    if (typeof jsBtn[i] == 'function') {
                        btn[i] = jsBtn[i];
                    } else {
                        // si el atributo tiene el nombre "text" quiere decir que voy
                        // a ingresarlo como texto dentro del html
                        if (i == 'text') {
                            $(btn).html(jsBtn[i]);
                        } else if ('id') {
                            continue;
                        } else {
                            $(btn).attr(i, jsBtn[i]);
                        }
                    }
                }
                // si no existe el type que sea button por default
                if ( !btn.type ) {
                    btn.type = 'button';
                }
                // lo agrego al listado de botones generados, para no generar 2 veces

                 // meto el boton en el menu
                $(btn).appendTo(this.defaults.menuControlls);
                btn.style.display = dis;

                btn.onclick = function(e){
                    e.preventDefault();
                    if (onClick) {
                        // ejecutar el evento oclick y luego, con el contenedor que devuelve
                        // meterlo en algun contenedr con pagesman
                        var ret = onClick();
                        if (ret) {
                            ret.pagesman();
                        }
                    }

                    // si es un link, entonces el evento click, sera
                    // un ajax que llame al href
                    if ( jsBtn.hasOwnProperty('href') ) {
                        $.get(jsBtn.href, function(t){
                            var newdiv = $('<div>');
                            newdiv.append(t);
                            newdiv.pagesman();
                        });
                    }
                    return false;
                };
                btn = $( btn );

                this.__pushButton(jsBtn.id, btn);
            } else if ( typeof btnElementId == 'string' ) {
                // si vino un string en lugar de un objeto es porque
                // quiero agarrar un boton previamente generado
                btn = this.__getButton(jsBtn);
            }
            console.info("boton registrado");
            console.debug(jsBtn);
            return btn;
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
        for (var m in mozos){
            if (!$.isEmptyObject(mozos[m])) {
                
                mozoaux = new Mozo();
                mozoaux.cloneFromJson(mozos[m].Mozo);
                
                mozoaux.User = mozos[m].User;
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
        for (d in data) {
            var mo = new Mozo();
            mo.cloneFromJson(data[d].Mozo)
            mozos.push(mo);
            for (a in data[d].Mesa) {
                var me = new Mesa();
                me.cloneFromJson(data[d].Mesa[a])
                me.setMozo(mo);
                mo.mesas.push(me);
                mesas.push(me);
            }
        }
        this.mozos = mozos;
        this.mesas = mesas;
    }

		
};
