var Producto = Class.create();

Producto.prototype ={
	  initialize: function() {
	    this.id = 0;
	    this.name = "";
	    this.abrev = "";
	    this.description = "";
	    this.categoria_id = 0;
	    this.precio = 0;
	    this.created = "";
	    this.modified = "";  
	  },
	  
	esIgual: function(otroProducto){
		return (this.getId == otroProducto.getId)?true:false;
	},
	
	getCantidad: function(){
		return this.cantidad;
	},

	getName: function(){
		return this.name;
	},
	
	getId: function(){
		return this.id;
	},
	
	getDescription: function(){
		return this.description
	},
	
	getAbrev: function(){
		return this.abrev
	},
	/**
	 * Convierte un JSON en un objecto producto
	 * @param prod JSOn del rpducto genralmente es el que viene de PHP
	 */
	copiar: function(prod){
		 prod =  eval( "(" + prod + ")" );  
		 this.id = prod.id;
		 this.name = prod.name;
		 this.abrev = prod.abrev;
		 this.description = prod.description;
		 this.categoria_id = prod.categoria_id;
		 this.precio = prod.precio;
		 this.created = prod.created;
		 this.modified = prod.modified;  
	}
	
	
}

