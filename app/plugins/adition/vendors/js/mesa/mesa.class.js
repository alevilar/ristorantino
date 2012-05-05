/*--------------------------------------------------------------------------------------------------- Risto.Adicion.mesa
 *
 *
 * Clase Mesa
 * 
 * para inicializarla es necesario pasarle el objeto Mozo
 * tambien se le puede pasar un jsonData para ser mappeado con knockout
 */
var Mesa = function(mozo, jsonData) {
        
        this.id             = ko.observable();
        this.created        = ko.observable();
        this.total          = ko.observable( 0 );
        this.numero         = ko.observable( 0 );
        this.menu           = ko.observable( 0 );
        this.descuento_id   = ko.observable( 0 );
        this.Descuento      = ko.observable( new Risto.Adition.descuento({porcentaje: undefined}) );
        this.mozo           = ko.observable( new Mozo() );
        this.currentComanda = ko.observable( new Risto.Adition.comandaFabrica() );
        this.Comanda        = ko.observableArray( [] );
        this.mozo_id        = this.mozo().id;
        this.Cliente        = ko.observable( null );
        this.estado         = ko.observable( MESA_ESTADOS_POSIBLES.abierta );
        this.estado_id      = ko.observable();
        this.Pago           = ko.observableArray( [] );
        this.cant_comensales= ko.observable(0);
        
        // agrego atributos generales
        Risto.modelizar(this);
        
        return this.initialize(mozo, jsonData);
}



Mesa.prototype = {
    model       : 'Mesa',
    
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
        var estado = MESA_ESTADOS_POSIBLES.abierta,
            ee = 0; // countador de estados posibles
         if (jsonData.estado_id) {
            for(ee in MESA_ESTADOS_POSIBLES){
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
    urlGetData: function() {return urlDomain+'mesas/ticket_view/'+this.id()},
    urlView: function() {return urlDomain+'mesas/view/'+this.id()},
    urlEdit: function() {return urlDomain+'mesas/ajax_edit/'+this.id()},
    urlDelete: function() {return urlDomain+'mesas/delete/'+this.id()},
    urlComandaAdd: function() {return urlDomain+'comandas/add/'+this.id()},
    urlReimprimirTicket: function() {return urlDomain+'mesas/imprimirTicket/'+this.id()},
    urlCerrarMesa: function() {return urlDomain+'mesas/cerrarMesa/'+this.id()},
    urlReabrir: function() {return urlDomain+'mesas/reabrir/'+this.id()},
    urlAddCliente: function( clienteId ){
        var url = urlDomain+'mesas/addClienteToMesa/'+this.id();
        if (clienteId){
            url += '/'+clienteId;
        }
        url += '.json';
        return url;
    },        
    

    /**
     * Disparador de triggers para el evento
     *
     **/
    __triggerEventCambioDeEstado: function(){
        
        var event =  {};
        event.mesa = this;
        this.estado().event( event );
    },

    /**
     * dispara un evento de mesa seleccionada
     */
    seleccionar: function() {
        var event =  {};
        event.mesa = this;
        MESA_ESTADOS_POSIBLES.seleccionada.event( event );
    },
    
    
    /**
     * cambia el estado de la mesa y lo envia vía ajax. Para ser modificado 
     * en bbdd.
     * En caso de error en el ajax la mesa vuelve a su estado anterior.
     * 
     * dispara el evento de cambio de estado. en caso de error lo dispararia 2 veces
     */
    cambioDeEstadoAjax: function(estado){
        var estadoAnt = this.getEstado(),
            mesa = this,
            $ajax; // jQuery Ajax object
            
        this.setEstado( estado );
        $ajax = $.get( estado.url+'/'+this.id() );
        $ajax.error = function(){
            mesa.setEstado( estadoAnt );
        }
    },

    /**
     * dispara un evento de mesa Abierta
     */
    setEstadoAbierta : function(){
        this.setEstado( MESA_ESTADOS_POSIBLES.abierta );
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
        var url = window.urlDomain + 'mesas/cerrarMesa' + '/' + this.currentMesa.id + '/0',
            self = this;
            
        $.get(url, {}, function(){
            self.setEstadoCerrada();
        });
        return this;
    },

    /**
     * Envia un ajax con la peticion de borrar esta mesa
     */
    borrar : function(){
        var url = window.urlDomain + 'mesas/delete/' +this.id,
            self = this;
        $.get(url, {}, function(){
            self.setEstadoBorrada()
        });
        return this;
    },

    
    
    /**
     * Si tiene un mozo setteado retorna true, caso contrario false
     * Verifica con el id del mozo (si es CERO es que no tiene mozo)
     * @return Boolean
     */
    tieneMozo: function(){
        var tiene = false;
        if ( this.mozo() !== {} || this.mozo() !== null ) {
            tiene = this.mozo().id() ? true: false;
        }
        return tiene;
    },


    /**
     * Setea el mozo a la mesa.
     * si agregarMesa es true, se agrega la mesa al listado de mesas del mozo
     * @param nuevoMozo Mozo es el mozo que voy a setear
     * @param agregarMesa Boolean indica si agrego la mesa al listado de mesas que tiene el mozo, por default es true
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
        return this;
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
    editar: function (data, callback) {
        if (!data['data[Mesa][id]']) {
            data['data[Mesa][id]'] = this.id();
        }
        $.post( window.urlDomain +'mesas/ajax_edit', data, callback);
        return this;
    },
    
    /**
     *  Es para realizar ediciones rapida de un valor de la mesa en BBDD
     *  dado un campo, se actualiza el valor que se haya pasado
     *  @param field String campo de la BBDD a actualizar
     *  @param value String es el valor a insertar en la BBDD
     *
     */
    saveField: function ( field, value, cbkSuccess, cbkError) {
        var data = {
            id: this.id(),
            model: 'Mesa',
            handleAjaxSuccess : cbkSuccess
        }
        data[field] = value;
        
        var sendOb = {
            obj: data,
            url: this.urlEdit(),
            error: cbkError
        }
        $cakeSaver.send(sendOb);
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
    
    setDescuento: function( objDescuento ) {
        var descuento_id;
        
        if ( objDescuento ) {
            descuento_id = objDescuento.id;
        }

        this.descuento_id( descuento_id );
        this.Descuento( new Risto.Adition.descuento(objDescuento) );
        this.saveField('descuento_id', descuento_id);
    },
    
    
    /**
     *
     * ELimina el descuento que tenia aplicado reseteando los valores 
     * de descuento_id y el objeto Descuento de la mesa
     */
    eliminarDescuento: function() {
        this.setDescuento({
             id : 0
        });
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
        
        var toDoAfterSave = function(data) {
            if ( data.Cliente ){
                ctx.Cliente( new Risto.Adition.cliente(data.Cliente) );
            } else{
                ctx.Cliente(null);
            }
        };
        
        this.saveField('cliente_id', clienteId, toDoAfterSave);
        
        return this;
    },
    
    
    /**
     * A diferencia de los otros totales, este no esta bindeado con knocout por lo tanto da el total real en el momento 
     * que se llama a esta funcion
     */
    totalStatic: function(){
        var total = 0,
            c, // index de Comandas
            dc; // index del for DetalleComandas
            
        for (c in this.Comanda()){
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
        var valorPorCubierto =  Risto.VALOR_POR_CUBIERTO || 0,
            total = this.cant_comensales() * valorPorCubierto,
            c = 0;

        for (c in this.Comanda()){
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
         *  si ademas de tener descuento el cliente, la mesa tiene otro descuento aplicado
         *  los suma
         *  @return Float
         */
       porcentajeDescuento : function(){
            var porcentaje = 0;
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') &&  this.Cliente().Descuento()){
                if ( typeof this.Cliente().Descuento().porcentaje == 'function') {
                    porcentaje = this.Cliente().Descuento().porcentaje();
                }
            }
            
            if (this.Descuento() && this.Descuento().hasOwnProperty('porcentaje')){
                if ( typeof this.Descuento().porcentaje == 'function') {
                    porcentaje += this.Descuento().porcentaje();
                }
            }
            
            return parseFloat( porcentaje );
        },
        
        
        
        /**
         *  Depende del cliente y el descuento de la mesa
         *  Me dice si la mesa tiene o no un descuento aplicado ya sea
         *  por el cliente o por el descuento de la mesa
         *  @return Boolean
         */
       tieneDescuento : function(){
            var tiene = false;
            if (this.Cliente() && !this.Cliente().hasOwnProperty('length') &&  this.Cliente().Descuento()){
                if ( typeof this.Cliente().Descuento().porcentaje == 'function') {
                    if ( this.Cliente().Descuento().porcentaje() > 0 ) {
                        tiene = true;
                    }
                }
            }
            
            if (this.Descuento() && this.Descuento().hasOwnProperty('porcentaje')){
                if ( typeof this.Descuento().porcentaje == 'function') {
                    if ( this.Descuento().porcentaje() > 0 ) {
                        tiene = true;
                    }
                }
            }
            
            return tiene;
        },
        
        
        
        /**
         *Devuelve el total aplicandole los descuentos
         *@return float
         */
        totalCalculado : function(){
            var total = parseFloat( this.total() );
            if ( total ) {
                return total;
            }
            
            total = this.totalCalculadoNeto();
            
            var dto = 0;
               
            dto = Math.floor(total * this.porcentajeDescuento() / 100);
            total = total - dto;
            
            return total;
        },
        
        
        /**
         *Devuelve el total mostrando un texto con el tipo de factura y, en caso de tenerlo, 
         *muestra el detalle del descuento que se le aplica
         *
         *@return String
         */
        textoTotalCalculado : function () {
            var totalNeto = this.totalCalculadoNeto(), 
                dto = 0, 
                totalNetoText = '$'+totalNeto ;
            
            if ( this.Cliente() && !this.Cliente().hasOwnProperty('length') ) {
                if (  this.Cliente().esTipoFactura('A') ) {               
                    totalNetoText = 'Factura "A" '+totalNetoText;
                } else if ( this.Cliente().esTipoFactura('B')) {
                    totalNetoText = 'Factura "B" '+totalNetoText;
                } else if ( this.Cliente().esTipoFactura('R')) {
                    totalNetoText = 'Remito '+totalNetoText;
                }
            }

            if ( this.porcentajeDescuento() ) {
                dto = Math.round( Math.floor( totalNeto * this.porcentajeDescuento()  / 100 ) *100 ) /100;
                totalNetoText = totalNetoText+' - $'+dto+' (Dto '+this.porcentajeDescuento()+'%) = $'+ this.totalCalculado();
            }
            
            return totalNetoText;
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
        
        
        /**
         * EN caso de que la mesa tenga un descuento apicado me devuelve el valor 
         * en formato texto
         * @return String
         */
        clienteDescuentoText: function(){
            var texto = '';
            if ( this.tieneDescuento() ) {
                texto = this.porcentajeDescuento()+"%";
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
