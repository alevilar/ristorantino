
/**
 * 
 *  esta clase es bascicamente un producto con la salvedad que se le agrega un campo de cantidad.

 *  Es para la comanda.
 *  vendrioa a ser la equivalencia con la tabla mesas-productos -> comanda de cada mesa
 * 
 */

var ProductoComanda = Class.create(Producto,{
	
	initialize: function() {
		this.cantidad = 0;
	},
	
	sumar: function(){
			this.cantidad++;
	},
	
	restar: function(){
		this.cantidad--;
	}
	
});
