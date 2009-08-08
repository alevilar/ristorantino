
/**
 * 
 *  esta clase es bascicamente un producto con la salvedad que se le agrega un campo de cantidad.
 *  Es para la comanda.
 *  vendrioa a ser la equivalencia con la tabla mesas-productos -> comanda de cada mesa
 * 
 */
var ProductoComanda = Class.create({
	initialize: function(prod) {
		this.producto = prod;
		this.cantidad = 0;
	},
	
	getCantidad: function(){
		return this.cantidad;
	},

	getName: function(){
		return this.producto.name;
	},
	
	getId: function(){
		return this.producto.id;
	},
	
	getDescription: function(){
		return this.producto.description
	},
	
	getAbrev: function(){
		return this.producto.abrev
	},
	
	sumar: function(){
			this.cantidad++;
	},
	
	restar: function(){
		this.cantidad--;
}
});