

var Producto = Class.create({
	  initialize: function() {
	    this.id;
	    this.name;
	    this.abrev;
	    this.description;
	    this.categoria_id;
	    this.precio;
	    this.created;
	    this.modified;    	
	    
	  },

	sumar: function(){
		this.cantidad++;
	},
	  
	esIgual: function(otroProducto){
		return (this.id == otroProducto.id)?true:false;
	}
	
	
});

