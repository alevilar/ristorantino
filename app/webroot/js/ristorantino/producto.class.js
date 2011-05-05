var Producto = {};

Producto.prototype ={
	  
	id : 0,
	name : "",
	abrev : "",
	description : "",
	categoria_id : 0,
	precio : 0,
	created : "",
	modified : "",
	comandera_id : 0,
	  
	  
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
	
	getComanderaId: function(){
		return this.comandera_id;
	},
	
	/**
	 * Convierte un JSON en un objecto producto
	 * @param prod JSOn del rpducto genralmente es el que viene de PHP
	 * @return prod el producto pero convertido en objeto con eval()
	 */
	copiar: function(prod){
		 if(Object.isString(prod)){
			  if(prod.isJSON()){
				  prod =  eval( "(" + prod + ")" );  
			  }
		 }
		
		this.id = prod.id;
		this.name = prod.name;
		this.abrev = prod.abrev;
		this.description = prod.description;
		this.categoria_id = prod.categoria_id;
		this.precio = prod.precio;
		this.created = prod.created;
		this.modified = prod.modified;
		this.comandera_id = prod.comandera_id;
		return prod;
	}
	
	
}

