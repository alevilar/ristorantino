

var FabricaMesa = Class.create({
	
	  initialize: function(mesaJSON) {
		if (mesaJSON){
			this.mesa = new Mesa();

			this.mesa.setId(mesaJSON.Mesa.id);
			this.mesa.setNumero(mesaJSON.Mesa.numero);
			this.mesa.setProductos(mesaJSON.Producto);
			return this.mesa;
		}
		else return null;
	  },
	  
	  getMesa: function(){
		  return this.mesa;
	  }

});