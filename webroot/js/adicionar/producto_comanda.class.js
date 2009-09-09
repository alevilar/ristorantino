
/**
 * 
 *  esta clase es bascicamente un producto con la salvedad que se le agrega un campo de cantidad.

 *  Es para la comanda.
 *  vendrioa a ser la equivalencia con la tabla mesas-productos -> comanda de cada mesa
 * 
 */

var ProductoComanda = Class.create(Producto,{
	
	initialize: function($super) {
		$super();
		this.cantidad = 0;
	},
	
	sumar: function(){
			this.cantidad++;
	},
	
	restar: function(){
		this.cantidad--;
	},
	
	/**
	 * Copia un producto para convertirlo en Producto Comanda
	 * @param Producto
	 */
	convertirEnProductoComanda: function(prod){
		if(prod.id ){
			 this.id = prod.id;  
		 }
		 
		 if(prod.name ){
			 this.name = prod.name;  
		 }
		 
		 if(prod.abrev ){
			 this.abrev = prod.abrev;  
		 }
		 
		 if(prod.description ){
			 this.description = prod.description;  
		 }
		 
		 if(prod.categoria_id ){
			 this.categoria_id = prod.categoria_id;  
		 }
		 
		 if(prod.precio ){
			 this.precio = prod.precio;  
		 }
		 
		 if(prod.created ){
			 this.created = prod.created;  
		 }

		 if(prod.modified ){
			 this.modified = prod.modified;  
		 }
 
		 if(prod.cantidad ){
			 this.cantidad = prod.cantidad;  
		 }
	}
	
});
