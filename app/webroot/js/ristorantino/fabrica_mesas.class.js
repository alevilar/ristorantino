

var FabricaMesa = Class.create({
	
	  initialize: function(mesaJSON) {
		if (mesaJSON){
			this.mesa = new Mesa();

			this.mesa.setId(mesaJSON.Mesa.id);
			this.mesa.setNumero(mesaJSON.Mesa.numero);
			
			this.mesa.clienteId = mesaJSON.Mesa.cliente_id;
			this.mesa.created = mesaJSON.Mesa.cliente_id;

			this.mesa.menu = mesaJSON.Mesa.menu;
			this.mesa.modified = mesaJSON.Mesa.modified;
			this.mesa.time_cerro = mesaJSON.Mesa.time_cerro;
			this.mesa.time_cobro = mesaJSON.Mesa.time_cobro;
			this.mesa.total = mesaJSON.Mesa.total;
			this.mesa.created = mesaJSON.Mesa.created;
				
			
			this.mesa.setProductos(mesaJSON.Producto);
			
			this.mesa.cliente = mesaJSON.Cliente;
			this.mesa.comensal = mesaJSON.Comensal;
				
			
			return this.mesa;
		}
		else return null;
	  },
	  
	  getMesa: function(){
		  return this.mesa;
	  }

});