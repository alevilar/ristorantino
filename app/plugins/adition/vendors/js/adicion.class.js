/**
 *  Adicion Class
 *
 *  constructor
 *
 */

var Adicion = function() {
    this.initialize();
}


//Parametros de configuracion
Adicion.cubiertosObligatorios   = true;
Adicion.menuControlls           = '.window_controll';



/**
 * extencion del objeto array
 *
 *
 * */
    
Adicion.prototype = {

    currentMozo: null,
    currentMesa: null,

    mozos: [],
    mesas: [],

    /**
     * Constructor
     */
    initialize: function() {
        this.getMesasAbiertas();
    },

    /**
     *Crea un elemento DOM con el TAG pasado como parametro
     *e inserta el objeto mesa a éste.
     *
     * Ej: mesasEnTag('A')
     * me devuelve un link con un atributo "mesa"
     *
     */
    mesasEnTag: function(templateString) {
        var tmpStr = templateString || "<button>${number}</button>";
        var mesasTags = [];
        var template = $.template( null, tmpStr );
        var tag;
        for(var m in this.mesas) {
            tag = $.tmpl(template, this.mesas[m]);
            tag[0].mesa = this.mesas[m];
            $(tag[0]).click( function() {
                this.mesa.seleccionar();
            });
            mesasTags.push(tag[0]);
        }
        return mesasTags;
    },
    mozosEnTag: function(tagName) {
        var mozosTags = [];
        for(var m in this.mozos) {
            var tag = document.createElement(tagName);
            tag.mozo = this.mozos[m];
            mozosTags.push(tag);
        }
        return mozosTags;
    },


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
        delete this.currentMesa;
        this.currentMesa = null;
    },

    setCurrentMesa: function(mesa) {
        this.currentMesa = mesa;
        console.debug(mesa);
        if (mesa.Mozo) {
            this.setCurrentMozo(mesa.Mozo);
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
        var elem = elementToUpdate || document.createElement('div');
        var url = window.urlDomain+'mesas/ticket_view' + '/'+this.currentMesa.id ;
        return $(elem).load(url);
    },


    cambiarNumeroMesa: function(){
        var numero = prompt('Nuevo Número de Mesa',this.currentMesa.numero);
        var ops = {
                'data[Mesa][numero]': numero
            };
        this.currentMesa.editar(ops);
    },


    /**
     *
     * Dado un Json arma el listado de mozos
     * @param json mozos
     */
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
                    context.__handleMesasAbiertasRecibidas(e, t);
                    $(document).trigger('adicionMesasActualizadas');
                },
                'json'
            );
        ajaxResp.error = function(){alert("fallo conexión")}
    },
    

    __handleMesasAbiertasRecibidas: function( data ) {
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
