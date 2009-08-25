



var FabricaMozo = Class.create({
	
	  initialize: function(mozoJSON) {	
		if (mozoJSON){
			this.mozo = new Mozo();
			this.mozo.setId(mozoJSON.Mozo.id);
			this.mozo.setNumero(mozoJSON.Mozo.numero);
			this.mozo.setApellido(mozoJSON.User.apellido);
			this.mozo.setNombre(mozoJSON.User.nombre);	
			this.mozo.setUsername(mozoJSON.User.username); 
			this.mozo.setMesas(mozoJSON.Mesa); 
			return this.mesa;
		}		
		else return null;
		
	  },
	  
	  getMozo: function(){
		  return this.mozo;
	  }

});