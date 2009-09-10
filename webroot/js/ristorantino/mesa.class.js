



var Mesa = Class.create({
	
		initialize: function() {		
			this.id;
			this.comensal;
		    this.productos;
		    this.numero;
		    this.cliente;
		},

		setId: function(id){
			this.id = id;
		},
		getId: function(){
			return this.id;
		},
		
		setComensal: function(comensal){
			this.comenzal = comensal;
		},
		getComensal: function(){
			return this.comensal;
		},
		
		setNumero: function(numero){
			this.numero = numero;
		},
		getNumero: function(){
			return this.numero;
		},
		
		setProductos: function(productos){
			this.productos = productos;
		}
		

});