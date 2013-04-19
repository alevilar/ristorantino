// Namespace koModel
Risto.koModel = Risto.koModel = Risto.koModel || {};

Risto.KoModel.mesa = {
     
    
    // Mozo Actualmente Activo
    currentMozo: ko.observable( new Mozo() ),
    
    // Mesa Actualmente activa
    currentMesa: ko.observable( new Mesa() ),
    
   
    
    // pagos seleccionado de la currentMesa en proceso de pago. es una variable temporal de estado
    pagos: ko.observableArray( [] ),
    
     

    /**
     * Setter de la currentMesa
     * @param mesa Mesa or Number . Le puedo pasar una Mesa o un Id de la mesa, da lo mismo.
     * @return Mesa o false en caso de que el ID pasado no exista
     */
    setCurrentMesa: function ( mesa ) {
        if ( typeof mesa == 'number') { // en caso que le paso un ID en lugar del objeto mesa
            mesa = this.findMesaById(mesa);           
        }
        this.currentMesa( mesa );
        if (mesa.mozo) {
            this.setCurrentMozo(mesa.mozo());
        }
        return this.currentMesa();
    },
		
         
              

    /**
     *  Vista rápida de ticket
     *  @param {DOM Element} elementToUpdate
     *  @return {jQUery} DOM element
     */
    ticketView: function ( elementToUpdate ) {
        var elem = elementToUpdate || document.createElement('div');
        var url = window.urlDomain+'mesas/ticket_view' + '/'+this.currentMesa.id ;
        return $(elem).load(url);
    },


 
    
    /**
     *  Tira un prompt para settear un numero 
     *  y actualizando el valor en la current mesa
     *
     */
    agregarMenu: function(){
        var menu = prompt('Nuevo Número de Mesa', this.currentMesa().menu());
        var ops = {
                'data[Mesa][menu]': menu
            };
        this.currentMesa().menu( menu );
        this.currentMesa().editar(ops);
    },
    
    
    
    /**
     *  Tira un prompt para settear la cantidad de cubiertos
     */
    agregarCantCubiertos: function(){
        var menu = prompt('Ingrese cantidad de Cubiertos', this.currentMesa().cant_comensales());
        menu = parseInt(menu);
        
        if ( menu && typeof menu == 'number' && menu > 0) {
             var ops = {
                'data[Mesa][cant_comensales]': menu
            };
            
            this.currentMesa().cant_comensales( menu );
            this.currentMesa().editar(ops);
        }        
    },






     /**
     *  Modifica el mozo atual por el que se le pasa como parametro
     *  Dispara el evento "adicionCambioMozo"
     * @param Mozo mozo
     */
    setCurrentMozo: function(mozo){
        this.currentMozo( mozo );
        var event = {};
        event.mozo = mozo;
        Risto.EventHandler.trigger('adicionCambioMozo',event);
        
    },
    
    
    

    /**
     * Variable de estado generada cuando se esta armando una comanda
     * son los productos seleccionados.
     * Retorna todos lso productos seleccionados para el armado de una DetalleComanda
     * @return Array
     */
    productosSeleccionados : function () {
        if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().productosSeleccionados ) {
            return this.currentMesa().currentComanda().productosSeleccionados();    
        } else {
            return [];
        }
    },


    /**
     * Variable de estado generada cuando se esta armando una comanda
     * son los sabores de un producto seleccionado
     * Retorna el listado de sabores seleccionados
     * @Return Array
     */
    currentSabores : function(){
        if ( this.currentMesa() && this.currentMesa().currentComanda() && this.currentMesa().currentComanda().currentSabores() ) {
            return this.currentMesa().currentComanda().currentSabores();    
        }
    },


    /**
     *  Toma los valores ingresados en los pagos y calcula el vuelto a devolver
     *  @return Float
     */
    vuelto : function () {
       var pagos = this.pagos(),
           sumPagos = 0,
           totMesa = Risto.koModel.mesa.currentMesa().totalCalculado(),
           vuelto = 0,
           retText = undefined;
       if (pagos && pagos.length) {
           for (var p in pagos) {
               if ( pagos[p].valor() ) {
                sumPagos += parseFloat(pagos[p].valor());
               }
           }
           vuelto = (sumPagos - totMesa);
           if (vuelto <= 0 ){
               retText = (vuelto);
           } else {
               retText = (vuelto);
           }
       }
       return retText;
    },



    /**
     * El vuelto a devolver pero ingresando un texto
     * Ej: Vuelto: $35
     * @return String
     */
    vueltoText : function () {
       var pagos = this.pagos(),
           sumPagos = 0,
           totMesa = Risto.Adition.adicionar.currentMesa().totalCalculado(),
           vuelto = 0,
           retText = 'Total: '+Risto.koModel.mesa.currentMesa().textoTotalCalculado();
       if (pagos && pagos.length) {
           for (var p in pagos) {
               if ( pagos[p].valor() ) {
                sumPagos += parseFloat(pagos[p].valor());
               }
           }
           vuelto = (totMesa - sumPagos);
           if (vuelto <= 0 ){
               retText = retText+'   -  Vuelto: $  '+Math.abs(vuelto);
           } else {
               retText = retText+'   -  ¡¡¡¡ Faltan: $  '+vuelto+' !!!';
           }
       }
       return retText;
    },
    
    
    
    
    
    /**
     *  Inicializacion para cargar una nueva comanda, es el que activa las variables
     *  creando un nuevo objeto mediante la Fabrica de Comandas. ComandaFabrica
     */
    nuevaComandaParaCurrentMesa: function () {
        this.currentMesa().nuevaComanda();
        return this;
    },
    
    
    /**
     *  Referencia al objeto Menu para que pueda ser utilizado como un Modelo de Knoclkout.js
     *  desde este objeto de adicion.
     */
    menu: function () {
        return Risto.menu.apply(Risto.menu, arguments);
    },
    
    
    
    tieneCurrentMesa: function(){
        if ( typeof Risto.Adicion.KoModelListadoMesa.currentMesa() == 'object')  {
            return true;
        } else {
            return false;
        }
    }
    
    
}


