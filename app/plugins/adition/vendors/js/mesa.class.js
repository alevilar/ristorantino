/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mesa
 *
 *
 * Clase Mesa
 * 
 * para inicializarla es necesario pasarle el objeto Mozo
 * tambien se le puede pasar un jsonData para ser mappeado con knockout
 */
var Mesa = function(mozo, jsonData) {
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize(mozo, jsonData);
}



Mesa.prototype = {
    model       : 'Mesa',
    id          : function( ) {return 0},
    total       : function( ) {return 0},
    numero      : function( ) {return 0},
    mozo_id     : function( ) {return 0},
    created     : function( ) {return 0},
    time_cerro  : function( ) {return 0},
    menu        : function( ) {return 0},
    Cliente     : function( ) {return null}, 
    estado      : function( ) {return MESA_ESTADOS_POSIBLES.abierta}, // objeto estado
    estado_id     : function( ) {return 0}, // bbdd estado_id
    cant_comensales: function( ) {return 0},
    
    // es la comanda que actualmente se esta haciendo objeto comandaFabrica
    /** @param currentComanda comandaFabrica **/
    currentComanda: function( ) {return new Risto.Adition.comandaFabrica()},
    Comanda     : function( ) {return []},
    Pago        : function( ) {return []}, // cantidad de pagos asociados a la mesa
    
    
    // attributos
    mozo: function( ) {return {}},
    
    /**
     * es timeCreated o sea la fecha de creacion del mysql timestamp
     * @return string timestamp
     **/
    timeAbrio: function(){
        if (!this.timeCreated) {
            Risto.modelizar(this);
        }
        return this.timeCreated();
    },

    /**
     *@constructor
     */
    initialize: function( mozo, jsonData ) {
        
        if ( typeof jsonData == 'undefined' ) return this;
        
        this.id             = ko.observable();
        this.created        = ko.observable();
        this.total          = ko.observable( 0 );
        this.numero         = ko.observable( 0 );
        this.menu          = ko.observable( 0 );
        this.mozo           = ko.observable( new Mozo() );
        this.currentComanda = ko.observable( new Risto.Adition.comandaFabrica() );
        this.Comanda        = ko.observableArray( [] );
        this.mozo_id        = this.mozo().id;
        this.Cliente        = ko.observable( null );
        this.estado         = ko.observable( MESA_ESTADOS_POSIBLES.abierta );
        this.estado_id      = ko.observable();
        this.Pago           = ko.observableArray( [] );
        this.cant_comensales= ko.observable(0);

        // mapea el objeto this usando ko.mapping
        this.__koMapp( jsonData, mozo);
        
        return this;
    },
    
    /**
     *  Actualiza el estado de la mesa con el json pasado
     */
    update: function( mozo, jsonData ) {
        
        // mapea el objeto this usando ko.mapping
        return this.__koMapp( jsonData, mozo );
//        this.setEstadoById();  
    },
    
    
    __koMapp: function( jsonData, mozo ) {
        var jsonData = jsonData || {},
            mapOps          = {};
            mozo = mozo || null;
        // si vino jsonData mapeo con koMapp
        if ( jsonData != {} ) {
            if (jsonData.Cliente && jsonData.Cliente.id){
                this.Cliente( new Risto.Adition.cliente( jsonData.Cliente ) );
            } else {               
                this.Cliente( null );
            }
            delete jsonData.Cliente;
            
            // si aun no fue mappeado
            mapOps = {
//                'ignore': ["Cliente"],
                'Comanda': {
                    create: function(ops) {
                        return new Risto.Adition.comanda(ops.data);
                    },
                    key: function(data) {
                        return ko.utils.unwrapObservable( data.id );
                    }
                }
            }
        }
        
        if ( mozo ) {
            // meto al mozo sin agregarle la mesa al listado porque seguramente vino en el json
            this.setMozo(mozo, false);
        }
        
        ko.mapping.fromJS(jsonData, mapOps, this);
        
        // meto el estado como Objeto Observable Estado
        this.__inicializar_estado( jsonData );

        
        
        return this;
    },
    
    /**
     * Inicializa el estado de la mesa en base al json pasada como parametro
     * o sea, convierte el id del estado que viene de la bbdd, a un objeto
     * "estado" que son los que estan en mesa.estados.class.js
     * @return MesaEstado
     */
    __inicializar_estado: function( jsonData ){
        var estado = MESA_ESTADOS_POSIBLES.abierta;
         if (jsonData.estado_id) {
            for(var ee in MESA_ESTADOS_POSIBLES){
                if ( MESA_ESTADOS_POSIBLES[ee].id && MESA_ESTADOS_POSIBLES[ee].id == jsonData.estado_id ){
                    estado = MESA_ESTADOS_POSIBLES[ee];
                    break;
                }
            }
         }
        this.setEstado( estado );
        return estado;
    },
    
    
    /**
     * agregar un producto a la comanda que actualmente se esta haciendo
     * no implica que se haya agregado un producto a la mesa.
     * es un estado intermedio de generacion de la comanda
     * @param prod Producto  
     **/
    agregarProducto: function(prod){
        this.currentComanda().agregarProducto(prod);
    },
    
    /**
     * Inicializa currentComanda para poder hacer una nueva comanda con
     * el objeto comandaFabrica
     * @constructor
     */
    nuevaComanda: function(){
        this.currentComanda( new Risto.Adition.comandaFabrica( this ) );
    },
    
    
    getData: function(){
        $.get(this.urlGetData());
    },
    
    
    /* listado de URLS de accion con la mesa */
    urlGetData: function(){return urlDomain+'mesas/ticket_view/'+this.id()},
    urlView: function(){return urlDomain+'mesas/view/'+this.id()},
    urlEdit: function(){return urlDomain+'mesas/ajax_edit/'+this.id()},
    urlDelete: function(){return urlDomain+'mesas/delete/'+this.id()},
    urlComandaAdd: function(){return urlDomain+'comandas/add/'+this.id()},
    urlReimprimirTicket: function(){return urlDomain+'mesas/imprimirTicket/'+this.id()},
    urlCerrarMesa: function(){return urlDomain+'mesas/cerrarMesa/'+this.id()},
    urlReabrir: function(){return urlDomain+'mesas/reabrir/'+this.id()},
    urlAddCliente: function( clienteId ){
        var url = urlDomain+'mesas/addClienteToMesa/'+this.id();
        if (clienteId){
            url += '/'+clienteId;
        }
        url += '.json';
        return url;
    },
    
    /**
     *  Id del elemento que contiene los datos de esta mesa
     *  es utilizada en el action mesas/view
     */
    domElementContainer: function(){return 'mesa-' + this.id();},
 

    

    /**
     * Disparador de triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        var event =  $.Event(this.estado().event);
        event.mesa = this;
        $(document).trigger(event);
    },

    /**
     * dispara un evento de mesa seleccionada
     */
    seleccionar: function() {
        var event =  $.Event(MESA_ESTADOS_POSIBLES.seleccionada.event);
        event.mesa = this;
        $(document).trigger(event);
        return this;
    },
    
    
    /**
     * cambia el estado de la mesa y lo envia vía ajax. Para ser modificado 
     * en bbdd.
     * En caso de error en el ajax la mesa vuelve a su estado anterior.
     * 
     * dispara el evento de cambio de estado. en caso de error lo dispararia 2 veces
     */
    cambioDeEstadoAjax: function(estado){
        var estadoAnt = this.getEstado();
        var mesa = this;
        this.setEstado( estado );
        var ajax = $.get( estado.url+'/'+this.id() );
        ajax.error = function(){
            mesa.setEstado( estadoAnt );
        }
    },

    /**
     * dispara un evento de mesa Abierta
     */
    setEstadoAbierta : function(){
        this.setEstado(MESA_ESTADOS_POSIBLES.abierta);
        return this;
    },
    
    /**
     * dispara un evento de mesa cobrada
     */
    setEstadoCobrada : function(){
        this.time_cobro( jsToMySqlTimestamp() );
        this.setEstado(MESA_ESTADOS_POSIBLES.cobrada);
        return this;
    },


    /**
     * dispara un evento de mesa cerrada
     */
    setEstadoCerrada : function(){
        this.time_cerro = jsToMySqlTimestamp();
        this.setEstado(MESA_ESTADOS_POSIBLES.cerrada);
        return this;
    },

    /**
     * dispara un evento de mesa borrada
     */
    setEstadoBorrada: function() {
        this.setEstado(MESA_ESTADOS_POSIBLES.borrada);
        return this;
    },

    /**
     * dispara un evento de mesa con cupon pendiente
     */
    setEstadoCuponPendiente : function(){        
        this.setEstado(MESA_ESTADOS_POSIBLES.cuponPendiente);
        return this;
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstado: function(nuevoestado){
        this.estado( nuevoestado );
        this.__triggerEventCambioDeEstado();
    },
    
    /**
     * Cambia el estado de la mesa y genera un disparador del evento
     */
    setEstadoById: function(nuevoestado_id){
        var estado_id = nuevoestado_id || this.estado_id();
        
        for (var est in MESA_ESTADOS_POSIBLES) {
            if ( MESA_ESTADOS_POSIBLES[est].id == estado_id ) {
                this.setEstado(MESA_ESTADOS_POSIBLES[est]);
                return this.getEstado();
            }
        }
        return false;
    },

    /**
     * devuelve el estado actual de la mesa
     * @return MesaEstado
     */
    getEstado: function(){
        return this.estado();
    },
    
    
    /**
     * devuelve el string que identifica como nombre al estado
     * es el atributo del objeto estado llamado msg
     * el objeto de estado de la mesa es el de mesa.estados.class.js
     */
    getEstadoName: function(){
        if (this.estado()){
            return this.estado().msg;
        }
        return '';
    },
    
    
    /**
         *  dependentObservable
         *  
         *  devuelve el nombre del icono (jqm data-icon) que tiene el estado 
         *  en el que la mesa se encuentra actualmente
         *  el nombre del icono sirve para manejar cuestiones esteticas y es definido
         *  en "mesa.estados.class.js"
         *  
         *  @return string
         *
         */
     getEstadoIcon: function(){
            if (this.estado()){
                return this.estado().icon;
            }
            return MESA_ESTADOS_POSIBLES.abierta.icon;
            
        },
        
    

    /**
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    estaAbierta : function(){

        return MESA_ESTADOS_POSIBLES.abierta == this.getEstado();
    },

    /**
     * @deprecated deberia usar estaCerrada
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    pidioCierre : function(){
        return this.estaCerrada();
    },

    
    /**
     * modifica el ID del la mesa
     */
    setId : function(id){
        this.id = id;
    },


    /**
     *devuelve la cantidad de comensales o cubiertos seteado en la mesa
     *@return integer
     */        
    getCantComensales : function(){
        return this.cantComensales();
    },

    /**
     * Envia un ajax con la peticion de imprimir el ticket para esta mesa
     */
    reimprimir : function(){
        var url = window.urlDomain+'mesas/imprimirTicket';
        $.get( url+"/"+this.id);
    },



    /**
     * re-abre una mesa
     *
     */
    reabrir : function(url){
        var data = {
                'data[Mesa][estado_id]': MESA_ESTADOS_POSIBLES.abierta.id,
                'data[Mesa][id]': this.id
        };

        $.post(url, data);
        this.setEstadoAbierta();
    },

    /**
     * Envia un ajax con la peticion de cerrar esta mesa
     */
    cerrar: function(){
        var url = window.urlDomain + 'mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0';
        var context = this;
        $.get(url, {}, function(){context.setEstadoCerrada();});
    },

    /**
     * Envia un ajax con la peticion de borrar esta mesa
     */
    borrar : function(){
        var url = window.urlDomain + 'mesas/delete/' +this.id;
        var context = this;
        $.get(url, {}, function(){context.setEstadoBorrada()});
    },

    
    
    /**
     * Si tiene un mozo setteado retorna true, caso contrario false
     * Verifica con el id del mozo (si es CERO es que no tiene mozo)
     * @return Boolean
     */
    tieneMozo: function(){
        return this.mozo().id() ? true: false;
    },


    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo
     */
    setMozo: function(nuevoMozo, agregarMesa){
        var laAgrego = agregarMesa || true; // por default sera true
        
        // si la mesa que le quiero agregar, tenia otro mozo
        // lo debo sacar, eliminandole la mesa de su listado de mesas
        if ( this.tieneMozo() ){
            var mozoViejo = this.mozo();
            // si era el mismo mozo no hacer nada
            if (mozoViejo.id() == nuevoMozo.id()) {
                return 0;
            }
            mozoViejo.sacarMesa(this);
        }
        
        this.mozo_id( nuevoMozo.id() );
        this.mozo(nuevoMozo);
        if (laAgrego) {
            this.mozo().agregarMesa(this);
        }
    },


    /**
     * Realiza una edicion rapida via Ajax del Model Mesa de Cakephp
     * o sea, desde aca se puede tcoar facilmente cualquier campo de la bbdd
     * siempre y cuando el parametro data respete la forma de los inputs de cake.
     * 
     * @param data Array los keys del array deben ser de la forma cake:
     *                      Ej: data['data[Mesa][cant_comensales]'] o data['data[Mesa][cliente_id]']
     *                      
     */
    editar: function(data) {
        if (!data['data[Mesa][id]']) {
            data['data[Mesa][id]'] = this.id;
        }
        $.post( window.urlDomain +'mesas/ajax_edit', data);
    },
    
    
    /**
     * Es el callback que recibe la actualizacion de las mesas via json desde 
     * cakeSaver
     */
    handleAjaxSuccess: function(data, action, method) {
        if (data[this.model]) {
            ko.mapping.fromJS( data[this.model], {}, this );
        }
    },
    
    
    /**
     * Dado un objeto cliente se setea el mismo a la mesa
     * @param objCliente Object que debe tener como atributos al menos un id
     */
    setCliente: function( objCliente ){
        var ctx = this, 
            clienteId = null;
        
        if ( objCliente ) {
            clienteId = objCliente.id;
        }
        $.get( this.urlAddCliente( clienteId ), function(data) {
            if ( data.Cliente ){
                ctx.Cliente( new Risto.Adition.cliente(data.Cliente) );
            } else{
                ctx.Cliente(null);
            }
        });
    },
    
    
    /**
     * A diferencia de los otros totales, este no esta bindeado con knocout por lo tanto da el total real en el momento 
     * que se llama a esta funcion
     */
    totalStatic: function(){
        var total = 0;
            
        for (var c in this.Comanda()){
            for (dc in this.Comanda()[c].DetalleComanda() ){
                total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
            }
        }

        return Math.round( total*100)/100;
    },
    
    
    
    
    
    
    
    
    
    
    
    /**
     *Devuelve el total neto, sin aplicar descuentos
     *@return float
     */
    totalCalculadoNeto: function(){
        var tam = this.Comanda().length;

        var valorPorCubierto = 0;
        if ( typeof VALOR_POR_CUBIERTO != 'undefined' && VALOR_POR_CUBIERTO > 0 ) {
            valorPorCubierto = VALOR_POR_CUBIERTO;
        }
        var cantCubierto = this.cant_comensales() * valorPorCubierto;
        var total = cantCubierto;

        for (var c in this.Comanda()){
            for (dc in this.Comanda()[c].DetalleComanda() ){
                total += parseFloat( this.Comanda()[c].DetalleComanda()[dc].precio() * this.Comanda()[c].DetalleComanda()[dc].realCant() );
            }
        }

        return Math.round( total*100)/100;
    },
        
        
        /**
         *
         *  Depende del cliente.
         *  es un atajo al porcentaje de descuento que tiene el cliente
         */
       porcentajeDescuento : function(){
            var porcentaje = 0;
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') &&  this.Cliente().Descuento()){
                if ( typeof this.Cliente().Descuento().porcentaje == 'function') {
                    porcentaje = this.Cliente().Descuento().porcentaje();
                }
            }
            return parseFloat( porcentaje );
        },
        
        /**
         *Devuelve el total aplicandole los descuentos
         *@return float
         */
        totalCalculado : function(){
            if ( this.total() ) {
                return this.total();
            }
            
            var total = this.totalCalculadoNeto(), 
                dto = 0,
                totalText = total;
               
            dto = Math.floor(total * this.porcentajeDescuento() / 100);
            totalText = total - dto;
            
            return totalText;
        },
        
        
        /**
         *Devuelve el total mostrando un texto
         *@return String
         */
        textoTotalCalculado : function(){
            var total = this.totalCalculadoNeto(), 
                dto = 0, 
                totalText = '$'+total ;
            
            
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') && this.Cliente().tipofactura().toLowerCase() == 'a'){               
                totalText = 'Factura "A" '+totalText;
            }

            if ( this.porcentajeDescuento() ) {
                dto = Math.round( Math.floor( total * this.porcentajeDescuento()  / 100 ) *100 ) /100;
                totalText = totalText+' - [Dto '+this.porcentajeDescuento()+'%] $'+dto+' = $'+ this.totalCalculado();
            }
            
            return totalText;
        },
        
        
        
        
         /**
         * dependentObservable
         * 
         * Chequea si la mesa esta con el estado: cerrada. (por lo general, lo que interesa
         * es saber que si no esta cerrada es porque esta abierta :-)
         * @return boolean
         **/
        estaCerrada : function(){
            return MESA_ESTADOS_POSIBLES.cerrada == this.estado();
        },
        
        
        clienteTipoFacturaText: function(){
            var texto = 'B';
            if ( this.Cliente() && typeof this.Cliente().getTipoFactura == 'function' ) {
                texto = this.Cliente().getTipoFactura();
            }
            return texto;
        },
        
        
        clienteDescuentoText: function(){
            var texto = '';
            if ( this.Cliente() &&  this.Cliente().tieneDescuento && this.Cliente().tieneDescuento() != undefined ) {
                texto = this.Cliente().getDescuentoText();
            }
            return texto;
        },
        
        
        /**
         * dependentObservable
         * 
         * Devuelve el nombre del Cliente si es que hay alguno setteado
         * en caso de no haber cliente, devuelve el string vacio ''
         *
         *@return string
         */
        clienteNameData : function() {
            var cliente = this.Cliente();
            if (cliente){
                if (typeof cliente == 'function') {
                    return cliente.nombre();
                } else {
                    return cliente.nombre;
                }
            }
            return '';
        },
        
        
        
        /**
         * Devuelve un texto con la hora
         * si la mesa esta cerrada, dice "Cerró: 14:35"
         * si esta aberta dice: "Abrió 13:22"
         */
        textoHora : function() {
            var date, txt;
            if ( this.getEstado() == MESA_ESTADOS_POSIBLES.cerrada ) {
                txt = 'Cerró a las ';
                if (typeof this.time_cerro == 'function') {
                    date =  mysqlTimeStampToDate(this.time_cerro());
                }
            } else {
                txt = 'Abrió a las ';
                if (typeof this.created == 'function') {
                    date = mysqlTimeStampToDate(this.created());            
                }
            }
            if ( !date ) {
                date = new Date();
            }
            return txt + date.getHours() + ':' + date.getMinutes() + 'hs';
        }

};

