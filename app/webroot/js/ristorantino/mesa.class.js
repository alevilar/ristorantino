



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


    this.setId = function(id){
        this.id = id;
    },

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
    },


    this.reimprimir = function(url){
        var urlcompleta = url+"/"+this.id;

        new Ajax.Request(urlcompleta, {
            method: 'post'
        });
    },




    /**
	 * Cancela el cierre de una mesa que previamente fue cerrada por el mozo
	 *
	 * el ticket ya fue impreso, pero en tal caso se puede modificar el total a mano
	 * o cancelar el tiquet a mano y volver  aimprimirlo
	 */
    this.reabrir = function(url){
        // "0000-00-00 00:00:00"
        return new Ajax.Request(url, {
            method: 'post',
            parameters: {
                'data[Mesa][time_cerro]': "0000-00-00 00:00:00",
                'data[Mesa][id]': this.id
            },
            onSuccess: function() {
                $("mesa-id-"+this.id).remove();
                return true;
            }.bind(this),
            onFailure: function(){
                alert("No se pudo abrir la mesa nuevamente");
                return false;
            }
        });

    },


    this.borrar = function(url){
            //return new Ajax.Request(url+'/'+this.id);
            window.location.href = url+'/'+this.id;
    }


};