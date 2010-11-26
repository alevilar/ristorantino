



var Mesa = function(json){

    this.id = 0;
    this.numero = 0;

    this.clienteId = null;
    this.created = null;
    this.menu = 0;
    this.modified = null;
    this.time_cerro = null;
    this.time_cobro = null;
    this.total = 0;
    this.productos = null;
    this.cliente = null;
    this.cantComensales = 0;


    if (json !== undefined) {
        this.protype = json;
    }

    	
    /**
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    this.pidioCierre = function(){
        if(this.time_cerro == '0000-00-00 00:00:00')
            return false;
        else
            return true;
    },


    this.tieneCliente = function(){
        console.debug(this.cliente);
        if (this.cliente.id != null ||this.cliente.id != undefined)
            return true;
        else
            return false;
    },
		
    /**
     * Me dice si la mesa pidio el cierre y esta pendiente de cobro
     * @return boolean true si ya cerro, false si esta abierta
     */
    this.estaAbierta = function(){
        if(this.pidioCierre())
            return false;
        else
            return true;
    },
    
    
    this.tieneMenu = function(){
        if (this.menu > 0)
            return this.menu;
        else
            return 0;
    },


    this.getCantComensales = function(){
        return this.cantComensales;
    }

};