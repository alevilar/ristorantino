



var Mesa = Class.create({
	
    initialize: function() {
        this.id;
        this.numero;
        this.menu = 0;
        this.modified = 0;
        this.time_cerro = 0;
        this.time_cobro = 0;
        this.total;
        this.created;
        this.cliente = null;
        this.cant_comensales = 0;
        this.productos;
    },

    setId: function(id){
        this.id = id;
    },
    getId: function(){
        return this.id;
    },
		
    setCantComensales: function(comensal){
        this.cant_comensales = comensal;
    },
    getCantComensales: function(){
        return this.cant_comensales;
    },
		
    setNumero: function(numero){
        this.numero = numero;
    },
    getNumero: function(){
        return this.numero;
    },
		
    setProductos: function(productos){
        this.productos = productos;
    },
		
    /**
		 * Me dice si esta mesa tiene setteado un cliente o no
		 * @return boolean
		 */
    tieneCliente: function(){
        var devolver = false;
        if(this.cliente){
            if(this.cliente.id){
                devolver = true;
            }
        }
        return devolver;
    },
		
    /**
		 * Me dice si esta mesa tiene setteado un menu
		 * @return boolean
		 */
    tieneMenu: function (){
        $('boton-menu').update('Menú');
        var devolver = false;
        if(this.menu != 0 && this.menu){
            devolver = true;
            $('boton-menu').update('Menú x '+this.menu);
        }
        return devolver;
    },
		
    /**
		 * Me dice si la mesa pidio el cierre y esta pendiente de cobro
		 * @return boolean true si ya cerro, false si esta abierta
		 */
    pidioCierre: function(){
        if(this.time_cerro == '0000-00-00 00:00:00')
            return false;
        else
            return true;
    },
		
    /**
		 * Me dice si la mesa pidio el cierre y esta pendiente de cobro
		 * @return boolean true si ya cerro, false si esta abierta
		 */
    estaAbierta: function(){
        if(this.pidioCierre())
            return false;
        else
            return true;
    }

    
		

});