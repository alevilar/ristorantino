



var FabricaMozo = function(mozoJSON){
    
    this.mozo = {};
	  
    if (mozoJSON){
            this.mozo = new Mozo();
            this.mozo.setId(mozoJSON.Mozo.id);
            this.mozo.setNumero(mozoJSON.Mozo.numero);
            this.mozo.setApellido(mozoJSON.User.apellido);
            this.mozo.setNombre(mozoJSON.User.nombre);
            this.mozo.setUsername(mozoJSON.User.username);
            this.mozo.setMesas(mozoJSON.Mesa);

            return this.mozo;
    }
    else return null
};

FabricaMozo.prototype = {
	  getMozo: function(){
		  return this.mozo;
	  }
};